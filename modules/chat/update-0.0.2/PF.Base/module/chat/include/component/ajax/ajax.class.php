<?php

	use WebSocket\Client;

	class Chat_Component_Ajax_Ajax extends Phpfox_Ajax {

		//socket init and is_online = 1
		public function initConnect(){

			$id = Phpfox::getUserId();

			Chat_Service_Chat::instance() -> userActive($id);

		}

		//send message
		public function sendMessage(){

			$id = $this -> get("id");
			$threadId = $this -> get("threadId");
			$type = $this -> get("type");
			$message = $this -> get("message");

			Chat_Service_Chat::instance() -> sendSocket($id,"message",$message,1,$threadId);

			ob_start();
			Phpfox::getComponent('chat.newmessage',array("message"=>$message), 'controller');
			$newMessage = ob_get_contents();
			ob_end_clean();

			echo json_encode(array("userId"=>$id,"message"=>$newMessage));

		}

		//init chat
		public function index(){
			Phpfox::getComponent('chat.index', null, 'controller');
		}

		//open messages user
		public function messages(){

			$id = $this -> get('id'); //rename idThread
			$idUser = $this -> get('idUser');

			if(Phpfox::getService('friend') -> isFriend(Phpfox::getUserId(),$idUser)){

				Phpfox::getComponent('chat.messages', array("id"=>$id,"idUser"=>$idUser), 'controller');
				Mail_Service_Process::instance()->threadIsRead($id);

			}

		}

		//previous messages user
		public function prevMessages(){

			$idThread = $this -> get('idThread');
			$iPage = $this -> get('iPage');

			Phpfox::getComponent('chat.prevmessages', array("idThread"=>$idThread,"iPage"=>$iPage), 'controller');

		}

		//sel friends
		public function friends(){
			Phpfox::getComponent('chat.friends', null, 'block');
		}

		//send socket information "userWrite"
		public function userWrite(){

			$fromId = $this -> get("fromId");

			Chat_Service_Chat::instance() -> userWrite($fromId);

		}

		//send messages user is read
		public function messagesRead(){

			$idThread = $this -> get("idThread");
			$fromId = $this -> get("fromId");

			if(Phpfox::getService('friend') -> isFriend(Phpfox::getUserId(),$fromId)){
			
				Mail_Service_Process::instance()->threadIsRead($idThread);	

			}
		}

	}
?>

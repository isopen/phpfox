<?php

use WebSocket\Client;

class Chat_Service_Chat extends Phpfox_Service {
	public function __construct() {
		$this->_sTable = Phpfox::getT('chat');
		$this->_tFriend = Phpfox::getT('friend');
	}

	/*
		Send type "message" into socket
		$id - recipient id
		$type - type message
		$message - text message
		$flagDatabase - entry into the database(if 1 then true else then false)
		$threadId - id thread dialog
	*/
	public function sendSocket($id,$type,$message,$flagDatabase,$threadId){

		if($flagDatabase == 1){

			Mail_Service_Process::instance()->add(array("thread_id"=>$threadId,"to"=>array($id),"attachment"=>"","message"=>$message));

		}

		ob_start();
		Phpfox::getComponent('chat.sendmessage', array("message"=>$message), 'controller');
		$newMessage = ob_get_contents();
		ob_end_clean();

		$message = array(
			"userId" => Phpfox::getUserId(),
			"type" => "message",
			"message" => $newMessage
		);

		Phpfox_Socket::instance() -> push($id,$message);

	}

	/*
		Send active user into database and send message into socket(all friends online).
	*/
	public function userActive($id){

		$this->database()->update($this->_tFriend,array("is_online"=>"1"),"friend_user_id=".$id);

		$friends = Phpfox::getService('friend') -> get('(friend.user_id='.Phpfox::getUserId().')AND(friend.is_online=1)')[1];
		$id = array();

		$i = 0;
		while($friends[$i]){
			array_push($id,$friends[$i]["user_id"]);
			$i++;
		}

		$message = array(
			"userId" => Phpfox::getUserId(),
			"type" => "online"
		);

		Phpfox_Socket::instance() -> push($id,$message);

	}

	/*
		Send socket information "userWrite"
	*/
	public function userWrite($id){

		$message = array(
			"userId" => Phpfox::getUserId(),
			"type" => "write"
		);

		Phpfox_Socket::instance() -> push($id,$message);

	}

	/*
		Send socket information "addFriend".(addFriend).
	*/
	public function addFriend($id){

		$message = array(
			"userId" => $id,
			"type" => "addFriend"
		);

		Phpfox_Socket::instance() -> push($id,$message);

		$this -> userActive($id); //all friend user send online. If brakes then TODO current user.

		$this -> userActive(Phpfox::getUserId());

	}

	/*
		Send socket information "removeFriend".(removeFriend).
	*/
	public function removeFriend($id){

		$message = array(
			"userId" => $id,
			"type" => "removeFriend"
		);

		Phpfox_Socket::instance() -> push($id,$message);

	}

}

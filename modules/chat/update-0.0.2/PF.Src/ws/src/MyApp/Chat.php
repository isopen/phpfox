<?php

	namespace MyApp;
	use Ratchet\MessageComponentInterface;
	use Ratchet\ConnectionInterface;

	class Chat implements MessageComponentInterface {

    	protected $connTable;
			protected $session;
			protected $idUsers = array();

    	public function __construct() {

       		$this -> connTable = new \SplObjectStorage;
					$this -> session = "core1d9auser_id";

    	}

    	public function onOpen(ConnectionInterface $conn) {

			$msgSocket = $conn -> WebSocket -> request -> getCookie($this -> session);

			if($msgSocket){

				$this -> connTable -> offsetSet($conn,$msgSocket);

				if(!(array_key_exists($msgSocket,$this -> idUsers))){

					$this -> idUsers[$msgSocket] = array($conn);
					echo "AuthUser::".$msgSocket."\n";
					echo "Count in users::".count($this -> idUsers)."\n";

				}else{

					if(count($this -> idUsers[$msgSocket]) <= 10){
						array_push($this -> idUsers[$msgSocket],$conn);
					}

				}

       			echo "New connection! ({$conn->resourceId})\n";

			}else{

				echo "Connection is not Phpfox!!!\n";

			}

    	}

		private function push($id,$msgUser){

			if (isset($this -> idUsers[$id])) {
				echo $msgUser."\n";
				foreach($this -> idUsers[$id] as &$id) {

    				$id -> send($msgUser);

				}
			}

		}

    	public function onMessage(ConnectionInterface $conn, $msgSocket) {

			try{

				$msgSocket = json_decode($msgSocket);

				$msgUser = json_encode($msgSocket -> message);

				if(is_array($msgSocket -> id)){

					foreach ($msgSocket -> id as &$id) {

   						$this -> push($id, $msgUser);

					}

				}else{

					$id = $msgSocket -> id;
					$this -> push($id, $msgUser);

				}

			}catch(Exception $e){}

    	}

    	public function onClose(ConnectionInterface $conn) {

				/*$msgSocket = $conn -> WebSocket -> request -> getCookie("core1d9auser_id");
				$message = array(
					"userId" => $msgSocket,
					"type" => "offline"
				);
				$message = array(
					"id" => $msgSocket,
					"message" => $message
				);
				$message = json_encode($message);
				$this -> onMessage($conn, $message);

				echo "ID offline::: ".$msgSocket."\n";*/

			$id = &$this -> idUsers[$this -> connTable[$conn]];

			unset($id[array_search($conn,$id)]);

			if(empty($id)){

				//close online current user(is_online=0)
				include "config.php";
				if ($mysqli->connect_errno) {
    				printf("Соединение не установлено: %s\n", $mysqli->connect_error);
				}else{

					$msgSocket = $conn -> WebSocket -> request -> getCookie($this -> session);
					$friend_user_id = array();
					$res = $mysqli -> query("SELECT pf.friend_user_id FROM phpfox_friend pf WHERE (pf.is_online=1)AND(pf.user_id=".$msgSocket.");");
					while($row = $res->fetch_assoc()){
						array_push($friend_user_id,$row["friend_user_id"]);
					}
					$res -> free();

					$message = array(
						"id" => $friend_user_id,
						"message" => array(
							"userId" => $msgSocket,
							"type" => "offline"
						)
					);
					$message = json_encode($message);
					$this -> onMessage($conn, $message);

					echo "ID offline::: ".$msgSocket."\n";

					$mysqli -> query("UPDATE phpfox_friend pf SET pf.is_online=0 WHERE pf.friend_user_id=".$this -> connTable[$conn].";");

				}
				$mysqli -> close();

				unset($this -> idUsers[$this -> connTable[$conn]]);

			}

			$this -> connTable -> offsetUnset($conn);

			echo "Count in users::".count($this -> idUsers)."\n";

        	echo "Connection {$conn->resourceId} has disconnected\n";

    	}

		public function onError(ConnectionInterface $conn, \Exception $e) {
        	echo "An error has occurred: {$e->getMessage()}\n";
        	$conn->close();
    	}

	}

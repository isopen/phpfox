<?php

	namespace MyApp;
	use Ratchet\MessageComponentInterface;
	use Ratchet\ConnectionInterface;

	class Chat implements MessageComponentInterface {

    	protected $connTable;
		protected $idUsers = array();

    	public function __construct() {

       		$this -> connTable = new \SplObjectStorage;

    	}

    	public function onOpen(ConnectionInterface $conn) {

			$msgSocket = $conn -> WebSocket -> request -> getCookie("core1d9auser_id");

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

			$id = &$this -> idUsers[$this -> connTable[$conn]];

			unset($id[array_search($conn,$id)]);

			if(empty($id)){

				//close online current user(is_online=0)
				include "config.php";
				if ($mysqli->connect_errno) {
    				printf("Соединение не установлено: %s\n", $mysqli->connect_error);
				}else{
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


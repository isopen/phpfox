<?php

	defined('PHPFOX') or exit('NO DICE!');

	use WebSocket\Client;

	class Phpfox_Socket {	

		public function __construct() {

			$this -> host = "ws://localhost:8080";

		}

		public static function instance(){

			return Phpfox::getLib("socket");

		}

		public function push($id,$message){

			if(($id != null)&&($message != null)){

				$client = new Client($this -> host);

				$message = array(
					"id" => $id,
					"message" => $message,
				);

				$message = json_encode($message);

				$client -> send($message);

				return true;

			}else{

				return false;

			}

		}
    
	}

?>

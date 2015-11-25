<?php

/*
	Template send socket
*/
class Chat_Component_Controller_Sendmessage extends Phpfox_Component {
        public function process() {

			$message = $this -> getParam('message');

			$user  = Phpfox::getService('user') -> getUser(Phpfox::getUserId());

			$this -> template()
				-> assign(array(
					'message' => $message,
					'user' => $user
				));

        }
}

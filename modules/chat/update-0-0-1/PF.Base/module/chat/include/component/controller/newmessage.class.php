<?php

/*
	Template send curr user
*/
class Chat_Component_Controller_Newmessage extends Phpfox_Component {
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

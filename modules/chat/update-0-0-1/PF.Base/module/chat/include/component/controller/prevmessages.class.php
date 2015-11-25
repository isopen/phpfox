<?php

class Chat_Component_Controller_Prevmessages extends Phpfox_Component {
        public function process() {

			$idThread = $this -> getParam('idThread');
			$iPage = $this -> getParam('iPage');
			
        	$messages = Mail_Service_Mail::instance()->getMail($idThread, $iPage);
        	$this -> template()
            	-> assign(array(
            		'messages' => $messages,
            	));

        }
}

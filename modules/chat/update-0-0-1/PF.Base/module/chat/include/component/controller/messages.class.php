<?php

class Chat_Component_Controller_Messages extends Phpfox_Component {
        public function process() {

			$id = $this -> getParam('id'); //rename idThread
			$idUser = $this -> getParam('idUser');
			
        	$messages = Mail_Service_Mail::instance()->getMail($id);

        	$this -> template()
            	-> assign(array(
            		'messages' => $messages,
					'idUser' => $idUser
            	));

        }
}

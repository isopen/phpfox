<?php
class Chat_Component_Controller_Index extends Phpfox_Component {
	public function process() {

		Phpfox::isUser(true);

        $this -> search() -> set(array(
					'type' => 'mail',
					'field' => 'mail.mail_id',
					'search_tool' => array(
						'table_alias' => 'm',
					'search' => array(
						'action' => $this->url()->makeUrl('mail', array('view' => $this->request()->get('view'), 'id' => $this->request()->get('id'))),
						'default_value' => Phpfox::getPhrase('mail.search_messages'),
						'name' => 'search',
						'field' => array('m.subject', 'm.preview')
					),
					'sort' => array(
						'latest' => array('m.time_stamp', Phpfox::getPhrase('mail.latest')),
						'most-viewed' => array('m.viewer_is_new', Phpfox::getPhrase('mail.unread_first'))
					),
					'show' => array(30)
				)
			)
		);
        $this -> search() -> setCondition('AND m.viewer_user_id = ' . Phpfox::getUserId() . ' AND m.is_archive = 0');

		$thread_id = Mail_Service_Mail::instance() -> get($this -> search() -> getSort())[1];

		$friends = Phpfox::getService('friend') -> get('friend.user_id='.Phpfox::getUserId())[1];

		$i = 0;
		while($friends[$i]){
			$friends[$i]["thread_id"] = 0;
			$j = 0;
			while($thread_id[$j]){
				if($friends[$i]["user_id"] == $thread_id[$j]["user_id"]){
					$friends[$i]["thread_id"] = $thread_id[$j]["thread_id"];
				}
				$j++;
			}
			$i++;
		}

		ob_start();
		Phpfox::getComponent('chat.friends', null, 'block');
		$templateFriends = ob_get_contents();
		ob_end_clean();

		$this -> template()
			-> assign(array(
    			'friends' => $friends,
				'templateFriends' => $templateFriends
			));

	}
}

<?php

class Chat_Component_Block_Friends extends Phpfox_Component {
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
		));

    $this -> search() -> setCondition('AND m.viewer_user_id = ' . Phpfox::getUserId() . ' AND m.is_archive = 0');

		$thread_id = Mail_Service_Mail::instance() -> get($this -> search() -> getSort())[1];

		$friends = Phpfox::getService('friend') -> get('friend.user_id='.Phpfox::getUserId(),'friend.is_online DESC')[1];

		$i = 0;
		while($friends[$i]){
			$friends[$i]["thread_id"] = 0;
			$j = 0;
			while($thread_id[$j]){
				if(($friends[$i]["user_id"] == $thread_id[$j]["user_id"])&&(count($thread_id[$j]["users"] == 1))){
					$friends[$i]["thread_id"] = $thread_id[$j]["thread_id"];
					$friends[$i]["viewer_is_new"] = $thread_id[$j]["viewer_is_new"];
					break;
				}
				$j++;
			}
			$i++;
		}

		$friends = $this -> array_msort($friends, array('viewer_is_new'=>SORT_DESC,'is_online'=>SORT_DESC,'user_id'=>SORT_ASC));

		$this -> template()
			-> assign(array(
    			'friends' => $friends,
					'm' => json_encode()
			));

	}

	private function array_msort($array, $cols){

		$colarr = array();
		foreach ($cols as $col => $order) {
			$colarr[$col] = array();
			foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
		}
		$eval = 'array_multisort(';
		foreach ($cols as $col => $order) {
			$eval .= '$colarr[\''.$col.'\'],'.$order.',';
		}
		$eval = substr($eval,0,-1).');';
		eval($eval);
		$ret = array();
		foreach ($colarr as $col => $arr) {
			foreach ($arr as $k => $v) {
					$k = substr($k,1);
					if (!isset($ret[$k])) $ret[$k] = $array[$k];
					$ret[$k][$col] = $array[$k][$col];
			}
		}
		return $ret;

	}

}

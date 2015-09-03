<?php

class Reviews_Component_Controller_Index extends Phpfox_Component {
	public function process() {
		$this->template()
			->setTitle('Отзывы')
			->setBreadCrumb('Отзывы')
			->setHeader(array(
				'styles.css' => 'module_reviews',
				'script.js' => 'module_reviews'
			));
	}
}

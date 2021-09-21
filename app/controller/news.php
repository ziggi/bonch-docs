<?php

class Controller_News extends Controller {

	function __construct() {
		parent::__construct();
		$this->model = new Model_News();
	}

	function mainAction() {
		$this->showAction();
	}

	function showAction() {
		$data = $this->model->getNews();

		if ($this->isAjax()) {
			$this->view->ajax('news.php', $data);
		} else {
			$this->view->generate('news.php', $data);
		}
	}

}

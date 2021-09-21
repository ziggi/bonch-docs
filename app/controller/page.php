<?php

class Controller_Page extends Controller {

	function __construct() {
		parent::__construct();
		$this->model = new Model_Page();
	}

	function mainAction() {
		$this->showAction();
	}

	function showAction($params = null) {
		if (empty($params)) {
			throw new Exception('Страница не найдена');
		}
		$data = $this->model->getPage($params);

		if ($this->isAjax()) {
			$this->view->ajax('page.php', $data);
		} else {
			$this->view->generate('page.php', $data);
		}
	}

}

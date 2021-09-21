<?php

class Controller_Item extends Controller {

	function __construct() {
		parent::__construct();
		$this->model = new Model_Item();
	}

	function mainAction() {
		$this->showAction();
	}

	function showAction($params) {
		$data = $this->model->getItem($params);

		if ($this->isAjax()) {
			$changeLayout = (bool)Kernel::app()->request()->get('changeLayout');
			if ($changeLayout) {
				$this->view->ajax('item/layout.php', $data);
				return;
			}

			$changeType = (bool)Kernel::app()->request()->get('changeType');
			if ($changeType) {
				$this->view->ajax('item/' . $params[1] . '.php', $data);
				return;
			}

			/*$changeContent = (bool)Kernel::app()->request()->get('changeContent');
			if ($changeContent) {
				$this->view->ajax('item.php', $data);
				return;
			}*/

			$this->view->ajax('item.php', $data);
		} else {
			$this->view->generate('item.php', $data);
		}
	}

	function downloadAction($params) {
		$success = $this->model->downloadItem($params[0]);
		if ($success == 0) {
			throw new Exception('Файл не существует');
		}
	}

}

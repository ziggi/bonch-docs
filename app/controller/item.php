<?php

class Controller_Item extends Controller {

	function __construct() {
		parent::__construct();
		$this->model = new Model_Item();
	}

	function mainAction() {
		$this->showAction();
	}

	function showAction($params = null) {
		if (empty($params)) {
			throw new Exception('Нет данных');
		}
		$data = $this->model->getItem($params);

		// getItem() redirected to the other item type
		if ($data === null) {
			return;
		}

		if ($this->isAjax()) {
			$changeLayout = (bool)Kernel::app()->request()->get('changeLayout');
			if ($changeLayout) {
				$this->view->ajax('item/layout.php', $data);
				return;
			}

			$changeType = (bool)Kernel::app()->request()->get('changeType');
			if ($changeType) {
				$this->view->ajax('item/' . ($params[1] ?? 'lection') . '.php', $data);
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
		$success = $this->model->downloadItem($params[0] ?? '');
		if ($success == 0) {
			throw new Exception('Файл не существует');
		}
	}

}

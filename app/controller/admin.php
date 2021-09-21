<?php

class Controller_Admin extends Controller {

	function __construct()
	{
		if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_USER'] != ADMIN_LOGIN || $_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD)
		{
			header("WWW-Authenticate: Basic realm=\"Need authorization\"");
			header("HTTP/1.0 401 Unauthorized");
			exit();
		}
		$this->model = new Model_Admin();
		$this->view = new View_Admin();
	}

	function mainAction($params) {
		$this->view->generate('main.php');
	}

	function pageAction($params) {
		$news_model = new Model_Admin_Page();

		$action = $params[0];
		if (empty($action)) {
			$action = 'add';
		}
		array_shift($params);

		// проверяем на существование
		if ( !method_exists($news_model, $action) ) {
			throw new Exception('Не найден обработчик');
		}

		$data = $news_model->$action( !empty($params[0]) ? $params : null );
		if (isset($data['error']) && !empty($_POST)) {
			switch ($data['error']) {
				case 0: $data['errorMsg'] = 'Страница успешно добавлена'; break;
				case 1: $data['errorMsg'] = 'Вы не заполнили все поля!'; break;
			}
		}
		$this->view->generate('page/' . $action . '.php', $data);
	}

	function newsAction($params) {
		$news_model = new Model_Admin_News();

		$action = $params[0];
		if (empty($action)) {
			$action = 'add';
		}
		array_shift($params);

		// проверяем на существование
		if ( !method_exists($news_model, $action) ) {
			throw new Exception('Не найден обработчик');
		}

		$data = $news_model->$action( !empty($params[0]) ? $params : null );
		if (!$this->isAjax()) {
			if (isset($data['error']) && !empty($_POST)) {
				switch ($data['error']) {
					case 0: $data['errorMsg'] = 'Новость успешно добавлена'; break;
					case 1: $data['errorMsg'] = 'Вы не заполнили все поля!'; break;
				}
			}
			$this->view->generate('news/' . $action . '.php', $data);
		}
	}

	function itemAction($params) {
		$news_model = new Model_Admin_Item();

		$action = $params[0];
		if (empty($action)) {
			$action = 'add';
		}
		array_shift($params);

		// проверяем на существование
		if ( !method_exists($news_model, $action) ) {
			throw new Exception('Не найден обработчик');
		}

		$data = $news_model->$action( !empty($params[0]) ? $params : null );
		if (!$this->isAjax()) {
			if (isset($data['error']) && !empty($_POST)) {
				switch ($data['error']) {
					case 0: $data['errorMsg'] = 'Элемент успешно добавлен'; break;
					case 1: $data['errorMsg'] = 'Вы не заполнили все поля!'; break;
					case 2: $data['errorMsg'] = 'Файл уже существует!'; break;
				}
			}
			$this->view->generate('item/' . $action . '.php', $data);
		}
	}

}

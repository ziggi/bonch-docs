<?php

class Route {
	
	static function init() {
		session_start();

		$db = ucfirst(DB_TYPE);
		$db = new $db;
		$db->connect();
	}

	static function start() {
		// контроллер, действие и параметры по умолчанию
		$controller = 'News';
		$action = 'main';
		$params = null;

		$uri = substr($_SERVER['REQUEST_URI'], strlen(SITE_PATCH) + 1);
		$routes = explode('/', $uri);

		// получаем имя контроллера
		if ( !empty($routes[0]) ) {	
			$controller = $routes[0];
		}
		
		// получаем имя экшена
		if ( !empty($routes[1]) ) {
			$action = $routes[1];
		}

		// получаем параметры
		if ( !empty($routes[2]) ) {
			$params = array_slice($routes, 2);
		}

		// запоминаем текущую страницу
		View::$current_page = $action . '/' . (!empty($params) ? implode('/', $params) : null);

		// добавляем префиксы
		$controller = 'Controller_'.$controller;
		$action = $action . 'Action';
		
		// проверяем на существование
		if ( !class_exists($controller) ) {
			throw new Exception('Не найден контроллер');
		}

		if ( !method_exists($controller, $action) ) {
			throw new Exception('Не найден обработчик');
		}

		// вызываем метод
		$controller = new $controller;
		$controller->$action($params);
	}

	static function error($e) {

		$error_msg = $e->getMessage();
		
		if (DEBUG == true) {
			$data = "Ошибка: " . $error_msg;
			$view = new View();

			$controller = new Controller();
			if ($controller->isAjax()) {
				$view->ajax('error.php', $data);
			} else {
				$view->generate('error.php', $data);
			}
			return;
		}

		header('HTTP/1.1 404 Not Found');
		header('Status: 404 Not Found');
		header('Location:'.SITE_URL.'404');
	}

}


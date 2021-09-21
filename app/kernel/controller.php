<?php

class Controller {

	public $model;
	public $view;

	function __construct() {
		$this->view = new View();
	}

	function isAjax() {
		if (isset($_POST['ajax'])) {
			return 1;
		}
		return 0;
	}

}

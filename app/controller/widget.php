<?php

class Controller_Widget extends Controller {

	static function getContent($widget_name, $param = null) {
		$widget_model = 'Model_Widget_' . $widget_name;
		$widget_model = new $widget_model;

		$data = $widget_model->getContent(View::$current_page, $param);
		return $data;
	}

}
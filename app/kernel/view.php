<?php

class View {
	private static $_vars = array();
	public static $current_page;

	function get($key) {
		return self::$_vars[$key];
	}

	function set($key, $value) {
		self::$_vars[$key] = $value;
	}

	function generate($content_view, $data = null) {
		$content_file = 'public/templates/' . TEMPLATE_NAME . '/views/' . $content_view;
		if ( !file_exists($content_file) ) {
			throw new Exception('Не найден вид');
		}

		include 'public/templates/' . TEMPLATE_NAME . '/template.php';
	}

	function widgetController() {
		return new Controller_Widget;
	}
	
	function ajax($content_view, $data = null) {
		$content_file = 'public/templates/' . TEMPLATE_NAME . '/views/' . $content_view;
		if ( !file_exists($content_file) ) {
			throw new Exception('Не найден вид');
		}
		
		include $content_file;
	}

}

class View_Admin extends View {

	function generate($content_view, $data = null) {
		$content_file = 'public/templates/admin/views/'.$content_view;
		if ( !file_exists($content_file) ) {
			throw new Exception('Не найден вид');
		}

		include 'public/templates/admin/template.php';
	}
	
	function ajax($content_view, $data = null) {
		$content_file = 'public/templates/admin/views/' . $content_view;
		if ( !file_exists($content_file) ) {
			throw new Exception('Не найден вид');
		}
		
		include $content_file;
	}
}

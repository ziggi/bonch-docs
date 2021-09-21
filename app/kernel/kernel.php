<?php

class Kernel {

	private $_request;

	public static function app() {
		return (new self);
	}

	public function request()
	{
		if ( ! $this->_request instanceof Request ) {
			$this->_request = new Request();
		}
		return $this->_request;
	}

	public static function loadClass($class) {
		$class = 'app/' . strtolower( str_replace('_', DIRECTORY_SEPARATOR, $class) ).'.php';
		
		if (file_exists($class)) {
			return require_once $class;
		}
		
		return 0;
	}

	public static function redirect($url) {
		header('Location: ' . $url);
	}

	public static function log($text) {
		$date = date("d.m.Y-H:i:s");
		$file = 'log.txt';

		$fileopen = fopen($file, "a");
		fputs($fileopen, "$date: " . $text . "\n");
		fclose($fileopen);
	}
	
}

<?php

class Request extends Kernel {
	
	public function get($field) {
		// todo: validation
		if ( !isset($_POST[$field]) || empty($_POST[$field]) ) {
			return null;
		}
		return $_POST[$field];
	}

	public function file($file_name, $field = null) {
		// todo: validation
		if ($field == null) {
			if ( !isset($_FILES[$file_name]) || empty($_FILES[$file_name]) ) {
				return null;
			}
			return $_FILES[$file_name];
		} else {
			if ( !isset($_FILES[$file_name][$field]) || empty($_FILES[$file_name][$field]) ) {
				return null;
			}
			return $_FILES[$file_name][$field];
		}
	}

}
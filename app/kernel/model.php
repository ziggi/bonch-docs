<?php

class Model {

	public $db;

	function __construct() {
		$this->db = ucfirst(DB_TYPE);
		$this->db = new $this->db;
	}

}

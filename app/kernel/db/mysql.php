<?php

class Mysql implements Database {
	private static $mysqli;
	
	public function connect() {
		self::$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_BASE);
		$this->query("SET NAMES utf8");
	}

	public function close() {
		return mysqli_close($this->mysqli);
	}

	public function query($query) {
		return mysqli_query(self::$mysqli, $query);
	}

	public function fetch_assoc($result) {
		return mysqli_fetch_assoc($result);
	}

	public function fetch_array($result) {
		return mysqli_fetch_array($result);
	}
	
	public function num_rows($result) {
		return mysqli_num_rows($result);
	}

	public function data_seek($result, $row_number) {
		return mysqli_data_seek($result, $row_number);
	}

}

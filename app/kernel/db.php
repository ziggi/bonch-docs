<?php

interface Database {
	
	public function connect();
	public function close();
	public function query($query);
	public function fetch_assoc($result);
	public function fetch_array($result);
	public function num_rows($result);
	public function data_seek($result, $row_number);

}

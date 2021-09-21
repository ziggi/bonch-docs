<?php

class Model_Admin_News extends Model_News {

	function add() {
		$request = Kernel::app()->request();

		$title = $request->get('inputTitle');
		$date = $request->get('inputDate');
		$text = $request->get('inputText');

		if ($title == null || $date == null || $text == null) {
			return array('error' => 1);
		}

		$this->db->query("INSERT INTO `news` (`Title`, `Text`, `Date`) VALUES ('$title', '$text', '$date')");
		
		return array('error' => 0);
	}

	function all() {
		return $this->getNews(true);
	}

	function edit($params) {
		$id = $params[0];
		
		$request = Kernel::app()->request();

		$title = $request->get('inputTitle');
		$date = $request->get('inputDate');
		$text = $request->get('inputText');
		
		$this->db->query("UPDATE `news` SET `Title`='$title',`Text`='$text',`Date`='$date' WHERE `ID`=$id");
		Kernel::redirect(SITE_URL . "admin/news/all");
	}

	function delete($params) {
		$id = $params[0];
		$this->db->query("DELETE FROM `news` WHERE `ID`=$id");
		Kernel::redirect(SITE_URL . "admin/news/all");
	}

}

<?php

class Model_Page extends Model {

	function getPage($params) {
		$page = urldecode($params[0]);

		$result = $this->db->query("SELECT * FROM `page` WHERE `Name`='$page'");

		if (!$result || $this->db->num_rows($result) == 0) {
			$data['errorMsg'] = 'Страница не найдена';
			return $data;
		}
		
		$array = $this->db->fetch_assoc($result);
		$data = array(
			'Name' => $array['Name'],
			'Title' => $array['Title'],
			'Text' => $array['Text']
		);
		
		return $data;
	}

}
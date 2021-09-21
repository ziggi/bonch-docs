<?php

class Model_Admin_Page extends Model_Page {

	function add() {
		$request = Kernel::app()->request();

		$title = $request->get('inputTitle');
		$name = $request->get('inputName');
		$text = $request->get('inputText');

		if ($title == null || $name == null || $text == null) {
			return array('error' => 1);
		}

		$result = $this->db->query("SELECT * FROM `page` ORDER BY `Position` DESC");
		$array = $this->db->fetch_assoc($result);
		$position = $array['Position'] + 1;

		$this->db->query("INSERT INTO `page` (`Position`, `Name`, `Title`, `Text`) VALUES ($position, '$name', '$title', '$text')");
		
		return array('error' => 0);
	}

	function all() {
		$result = $this->db->query("SELECT * FROM `page` ORDER BY `Position`");
		if (!$result || $this->db->num_rows($result) == 0) {
			$data['errorMsg'] = 'Страница не найдена';
			return $data;
		}
		
		$data = array();
		$data['lastPosition'] = null;
		$data['firstPosition'] = null;
		while ($array = $this->db->fetch_assoc($result)) {
			if ($data['lastPosition'] < $array['Position'] || $data['lastPosition'] == null) {
				$data['lastPosition'] = $array['Position'];
			}
			if ($data['firstPosition'] > $array['Position'] || $data['firstPosition'] == null) {
				$data['firstPosition'] = $array['Position'];
			}
			$data[] = array(
				'Name' => $array['Name'],
				'Title' => $array['Title'],
				'Text' => $array['Text'],
				'Position' => $array['Position'],
			);
		}
		return $data;
	}
	
	function edit() {
		$request = Kernel::app()->request();
		
		$title = $request->get('inputTitle');
		$name = $request->get('inputName');
		$text = $request->get('inputText');
		
		$this->db->query("UPDATE `page` SET `Title`='$title',`Name`='$name',`Text`='$text' WHERE `Name`='$name'");
		Kernel::redirect(SITE_URL . "admin/page/all");
	}
	
	function update($params) {
		$name = urldecode($params[0]);
		$type = $params[1];

		switch ($type) {
			case 'position':
				$pos_type = $params[2];

				$result = $this->db->query("SELECT * FROM `page` WHERE `Name`='$name'");
				$array = $this->db->fetch_assoc($result);

				$new_position = $array['Position'];
				$old_position = $array['Position'];

				if ($pos_type == 'up') {
					$new_position--;
				} else if ($pos_type == 'down') {
					$new_position++;
				}

				$this->db->query("UPDATE `page` SET `Position`=$old_position WHERE `Position`='$new_position'");
				$this->db->query("UPDATE `page` SET `Position`=$new_position WHERE `Name`='$name'");
				break;
		}

		Kernel::redirect(SITE_URL . "admin/page/all");
	}

	function delete($params) {
		$name = urldecode($params[0]);
		$this->db->query("DELETE FROM `page` WHERE `Name`='$name'");
		Kernel::redirect(SITE_URL . "admin/page/all");
	}

}

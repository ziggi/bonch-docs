<?php

class Model_Widget_ItemTypeMenu extends Model {

	public function getContent($active_name, $sem_num = null) {
		$params = explode('/', $active_name);
		$item_name = $params[1] ?? '';

		$result = $this->db->query("SELECT * FROM `categories` WHERE `Name`='$item_name'");

		if (empty($result)) {
			throw new Exception('Нет данных');
		}

		$categories_count = $this->db->num_rows($result);
		if ($categories_count == 0) {
			throw new Exception('Нет данных');
		}

		$categories_array = $this->db->fetch_assoc($result);
		$category_id = $categories_array['ID'];

		$result = null;
		if ($sem_num != null) {
			$sem_date = $this->getDateBySemester($sem_num);
			$date_from = sprintf('%04d-%02d-01 00:00:00', $sem_date['year'], $sem_date['month']);

			$sem_date = $this->getDateBySemester($sem_num + 1);
			$date_to = sprintf('%04d-%02d-01 00:00:00', $sem_date['year'], $sem_date['month']);

			$result = $this->db->query("SELECT `Type` FROM `item` WHERE `CategoryID`=$category_id AND `CreationDate`>='$date_from' AND `CreationDate`<'$date_to'");
		} else {
			$result = $this->db->query("SELECT `Type` FROM `item` WHERE `CategoryID`=$category_id");
		}

		$type_array = array();
		while ($array = $this->db->fetch_assoc($result)) {
			$type_array[] = $array['Type'];
		}
		$type_array = array_unique($type_array);
		$name_array = array();

		$result = $this->db->query("SELECT * FROM `type`");
		while ($array = $this->db->fetch_assoc($result)) {
			$name_array[$array['Type']] = $array['Name'];
		}

		$result_data = array();
		foreach ($type_array as $row) {
			$active = (($params[2] ?? null) == $row) ? 1 : 0;
			$result_data[] = array('Name' => $row, 'Title' => $name_array[$row] ?? $row, 'Active' => $active);
		}

		return $result_data;
	}

	function getDateBySemester($semester)
	{
		$year = null;
		$month = null;

		if ($semester % 2 !== 0) {
			$course_num = ($semester - 1) / 2;
			$year = 2012 + $course_num;
			$month = 9;
		} else {
			$course_num = $semester / 2;
			$year = 2012 + $course_num;
			$month = 1;
		}

		return array(
			'year' => $year,
			'month' => $month
		);
	}
}

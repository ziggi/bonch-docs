<?php

class Model_Widget_PageMenu extends Model {

	public function getContent($active_name) {

		$result_data = array();

		$result = $this->db->query("SELECT * FROM `page` ORDER BY `Position`");
		while ($array = $this->db->fetch_assoc($result)) {
			// запись данных в массив
			$result_data[] = array(
				'Name' => $array["Name"],
				'Title' => $array["Title"],
				'Active' => ($active_name == 'show/' . $array['Name'] ? 1 : 0),
			);
		}
		return $result_data;
	}
}

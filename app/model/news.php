<?php

class Model_News extends Model {

	function getNews($isAdmin = false) {
		$result = $this->db->query("SELECT * FROM `news` ORDER BY `Date` DESC");
		if (!$result || $this->db->num_rows($result) == 0) {
			$data['errorMsg'] = 'Новостей нет';
			return $data;
		}
		
		$data = array();
		while ($array = $this->db->fetch_assoc($result)) {
			$data[] = array(
				'ID' => $array['ID'],
				'Title' => $array['Title'],
				'Text' => $array['Text'],
				'Date' => $isAdmin ? $array['Date'] : $this->formatDate($array['Date']),
			);
		}
		
		return $data;
	}
	
	function formatDate($date)
	{
		$aMonth = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');

		$time = strtotime($date);
		$date = date('j m Y в H:i', $time);
		$array = explode(' ', $date);
		$array[1] = $aMonth[ $array[1] - 1 ];

		return implode(' ', $array);
	}
}

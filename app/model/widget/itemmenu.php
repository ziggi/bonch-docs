<?php

class Model_Widget_ItemMenu extends Model_Item {

	public function getContent($active_name) {

		$result_data = array();
		
		// есть ли лекции вообще
		$result_lectures = $this->db->query("SELECT * FROM `item`");
		if (!$result_lectures || $this->db->num_rows($result_lectures) == 0) {
			throw new Exception('Нет данных');
		}
		
		// заполняем массив категориями, в которых есть лекции
		$categories_showing = array();
		$sems_array = array();
		while ($array = $this->db->fetch_assoc($result_lectures)) {
			$type = $array['Type'];
			if (!isset($categories_showing[$type]) || !in_array($array['CategoryID'], $categories_showing[$type])) {
				$categories_showing[$type][] = $array['CategoryID'];
			}
			
			// записываем высший семестр
			$category_id = $array['CategoryID'];
			
			// находим семестр
			preg_match("/(\d+)-(\d+)-\d+/", $array["CreationDate"], $matches);
			$year = $matches[1];
			$month = (int)$matches[2];
			
			$course_num = $year - 2012;
			$current_sem = 0;

			if ($month >= 9) {
				$course_num += 1;
				$current_sem = $course_num * 2 - 1;
			} else {
				$current_sem = $course_num * 2;
			}
			
			if (!isset($sems_array[$category_id])) {
				$sems_array[$category_id] = $current_sem;
			} else if ($sems_array[$category_id] < $current_sem) {
				$sems_array[$category_id] = $current_sem;
			}
		}

		$result = $this->db->query("SELECT * FROM `categories` ORDER BY `Label`");
		while ($array = $this->db->fetch_assoc($result)) {
			// проверка категории на заблокированность
			if ($array['Visible'] == 0) {
				continue;
			}
			
			// проверяем наличие категории в массиве отображения
			$sem = null;
			$itemType = 'lection';
			$skip_category = true;
			foreach ($categories_showing as $type => $value) {
				foreach ($value as $category) {
					if ($category == $array['ID']) {
						$skip_category = false;
						$itemType = $type;
						if (isset($sems_array[$category])) {
							$sem = $sems_array[$category];
						}
						break;
					}
				}
				if ($skip_category == false && $itemType == 'lection') {
					break;
				}
			}
			if ($skip_category == true) {
				continue;
			}
			
			// запись данных в массив
			$result_data[] = array(
				'Name' => $array["Name"],
				'Type' => $itemType,
				'Label' => $array["Label"],
				'Sem' => $sem,
				'Active' => preg_match('/show\/' . $array['Name'] . '/', $active_name),
			);
		}
		return $result_data;
	}
}

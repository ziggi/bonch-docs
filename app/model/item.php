<?php

class Model_Item extends Model
{
	public function getItem($params)
	{
		$item_name = preg_replace("/[^a-z]+/i", "", $params[0]);
		$item_type = isset($params[1]) ? $params[1] : 'lection';
		$sem_number = isset($params[2]) ? (int)$params[2] : null;
		$result = $this->db->query("SELECT * FROM `categories` WHERE `Name`='$item_name'");

		if (empty($result)) {
			throw new Exception('Нет данных');
		}

		$categories_count = $this->db->num_rows($result);
		if ($categories_count == 0) {
			throw new Exception('Нет данных');
		}

		$categories_array = $this->db->fetch_assoc($result);

		$result_data[0]['Name'] = $categories_array['Name'];
		$result_data[0]['Label'] = $categories_array['Label'];
		$result_data[0]['Visible'] = $categories_array['Visible'];
		$result_data[0]['Type'] = $item_type;
		if ($categories_array['Visible'] == 0) {
			throw new Exception('Доступ запрещён');
		}

		$type_is = null;
		$sems_array = array();
		$result = $this->db->query("SELECT `Type`,`CreationDate` FROM `item` WHERE `CategoryID`=".$categories_array['ID']);
		while ($item_array = $this->db->fetch_assoc($result)) {
			if ($type_is != 1) {
				if ($item_array['Type'] == $item_type) {
					$type_is = 1;
				} else {
					$type_is = $item_array['Type'];
				}
			}

			$item_sem = $this->getSemester($item_array["CreationDate"]);

			if ( !isset( $sems_array[$item_sem] ) ) {
				$sems_array[$item_sem] = array('Active' => 0);
			}
		}
		if ($type_is != 1) {
			Kernel::app()->redirect(SITE_URL . "item/show/" . $item_name . "/" . $type_is);
			return;
		}
		if ($sem_number == null) {
			$sem_number = max( array_keys($sems_array) );
		}

		$sems_array[$sem_number]['Active'] = 1;
		$result_data[0]['Sems'] = $sems_array;

		$sem_date = $this->getDateBySemester($sem_number);
		$date_from = $sem_date['year'] . "-" . $sem_date['month'] . "-00 00:00:00";

		$sem_date = $this->getDateBySemester($sem_number + 1);
		$date_to = $sem_date['year'] . "-" . $sem_date['month'] . "-00 00:00:00";

		$result = $this->db->query("SELECT * FROM `item` WHERE `Type`='$item_type' AND `CategoryID`=".$categories_array['ID']." AND `CreationDate`>='$date_from' AND `CreationDate`<'$date_to' ORDER BY `CreationDate`");
		if (empty($result) || $this->db->num_rows($result) == 0) {
			$result_data['error'] = 1;
			$result_data['errorMsg'] = "Нет данных";
			return $result_data;
		}

		while ($item_array = $this->db->fetch_assoc($result)) {
			$item_sem = $this->getSemester($item_array["CreationDate"]);

			if ($sem_number == $item_sem) {
				$result_data[] = array(
					'Type' => $item_array["Type"],
					'Name' => $item_array["Name"],
					'About' => $item_array["About"],
					'Description' => $item_array["Description"],
					'CreationDate' => $this->formatDate($item_array["CreationDate"]),
					'EditionDate' => $this->formatDate($item_array["EditionDate"]),
					'FileHash' => $this->getFileHash( $item_array["FileID"] ),
					'PackFileHash' => $item_array["PackFileHash"],
				);
			}
		}
		return $result_data;
	}

	public function downloadItem($file_hash) {
		if (!preg_match('/^[a-f0-9]*$/i', $file_hash)) {
			return 0;
		}

		$result = $this->db->query("SELECT * FROM `files` WHERE `Hash`='$file_hash'");
		if (empty($result) || $this->db->num_rows($result) == 0) {
			return 0;
		}

		$array = $this->db->fetch_assoc($result);
		$file_id = $array['ID'];
		$file_name = $array['FileName'];
		$file_downloads = $array['Downloads'] + 1;
		$this->db->query("UPDATE `files` SET `Downloads`=$file_downloads WHERE `Hash`='$file_hash'");

		$result = $this->db->query("SELECT * FROM `item` WHERE `FileID`=$file_id");
		$array = $this->db->fetch_assoc($result);
		$category_id = $array['CategoryID'];

		$result = $this->db->query("SELECT * FROM `categories` WHERE `ID`=$category_id");
		$array = $this->db->fetch_assoc($result);
		$category_name = $array['Name'];

		$file = SITE_DIR . 'files/' . $category_name . '/' . $file_name;

		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . $file_name);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			// читаем файл и отправляем его пользователю
			readfile($file);
			return 1;
		}
		return 0;
	}

	public function getFileHash($file_id) {
		$result = $this->db->query("SELECT `Hash` FROM `files` WHERE `ID`=$file_id");
		$array = $this->db->fetch_assoc($result);
		return $array['Hash'];
	}

	function formatDate($date)
	{
		$aMonth = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');

		$date = substr($date, 0, 10);
		$time = strtotime($date);
		$date = date('j m Y', $time);
		$array = explode(' ', $date);
		$array[1] = $aMonth[ $array[1] - 1 ];

		return implode(' ', $array);
	}

	function getSemester($date)
	{
		preg_match("/(\d+)-(\d+)-\d+/", $date, $matches);
		$year = $matches[1];
		$month = (int)$matches[2];

		$course_num = $year - 2012;
		$item_sem = 0;

		if ($month >= 9) {
			$course_num += 1;
			$item_sem = $course_num * 2 - 1;
		} else {
			$item_sem = $course_num * 2;
		}
		return $item_sem;
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

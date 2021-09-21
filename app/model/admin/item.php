<?php

class Model_Admin_Item extends Model_Item {

	function add() {
		$result_data = array('error' => 0);

		$result = $this->db->query("SELECT * FROM `categories`");
		while ($array = $this->db->fetch_assoc($result)) {
			$result_data['categories'][] = array(
				'Label' => $array['ShortLabel'],
				'Name' => $array['Name'],
				'ID' => $array['ID'],
			);
		}

		$request = Kernel::app()->request();

		$category_label = $request->get('inputCategory');
		$type = $request->get('inputType');
		$name = $request->get('inputName');
		$about = $request->get('inputAbout');
		$creation_date = $request->get('CreationDate');
		$edition_date = $request->get('EditionDate');
		$description = $request->get('inputDescription');
		$file = $request->file('inputFile');

		if ($category_label == null || $type == null || $creation_date == null || $edition_date == null || $file == null) {
			$result_data['error'] = 1;
			return $result_data;
		}
		if ($type != "Лекции") {
			if ($name == null) {
				$result_data['error'] = 1;
				return $result_data;
			}
		}

		$result = $this->db->query("SELECT * FROM `type` WHERE `Name`='$type'");
		$array = $this->db->fetch_assoc($result);
		$type = $array['Type'];

		$category_name = null;
		$category_id = null;
		foreach ($result_data['categories'] as $row) {
			if ($row['Label'] == $category_label) {
				$category_name = $row['Name'];
				$category_id = $row['ID'];
			}
		}

		$file_dir = SITE_DIR . 'files/' . $category_name . '/' . $file['name'];
		if (file_exists($file_dir)) {
			$result_data['error'] = 2;
			return $result_data;
		}
		move_uploaded_file($file["tmp_name"], $file_dir);

		$result = $this->db->query("SELECT MAX(`ID`) FROM `files`");
		$array = $this->db->fetch_array($result);
		$file_id = $array[0] + 1;
		$file_hash = substr(md5($file['name'] . time() ), 0, 6) . ($file_id + 1);

		$this->db->query("INSERT INTO `files` (`FileName`, `Hash`) VALUES ('" . $file['name'] . "', '$file_hash')");
		$this->db->query("INSERT INTO `item`
			(`Type`, `Name`, `About`, `Description`, `CategoryID`, `CreationDate`, `EditionDate`, `FileID`)
			VALUES
			('$type', '$name', '$about', '$description', $category_id, '$creation_date', '$edition_date', $file_id)");

		return $result_data;
	}

	function all() {
		$result_data = array();

		$result = $this->db->query("SELECT * FROM `categories`");
		while ($array = $this->db->fetch_assoc($result)) {
			$result_data['categories'][] = array(
				'Label' => $array['ShortLabel'],
				'Name' => $array['Name'],
				'ID' => $array['ID'],
			);
		}

		$result = $this->db->query("
			SELECT
				`item`.`Id`,
				`item`.`Name`,
				`categories`.`ShortLabel`,
				`files`.`Downloads`
			FROM `item`
			INNER JOIN `categories` ON `categories`.`ID`=`item`.`CategoryID`
			INNER JOIN `files` ON `files`.`ID`=`item`.`FileID`
			ORDER BY `item`.`Id` DESC
		");
		if (!$result || $this->db->num_rows($result) == 0) {
			$result_data['errorMsg'] = 'Страница не найдена';
			return $result_data;
		}

		while ($array = $this->db->fetch_assoc($result)) {
			$result_data[] = array(
				'Id' => $array['Id'],
				'Name' => $array['Name'],
				'Category' => $array['ShortLabel'],
				'Downloads' => $array['Downloads'],
			);
		}
		return $result_data;
	}

	function update($params) {
		/*$id = $params[0];
		$text = nl2br( Kernel::app()->request()->get('value') );
		$this->db->query("UPDATE `item` SET `Text`='$text' WHERE `ID`=$id");*/
	}

	function delete($params) {
		$id = $params[0];

		$result = $this->db->query("
			SELECT
				`categories`.`Name` as `CategoryName`,
				`files`.`FileName`
			FROM `item`
			INNER JOIN `categories` ON `categories`.`ID`=`item`.`CategoryID`
			INNER JOIN `files` ON `files`.`ID`=`item`.`FileID`
			WHERE `item`.`Id`=$id
		");
		$array = $this->db->fetch_assoc($result);

		$file_name = SITE_DIR . 'files/' . $array['CategoryName'] . '/' . $array['FileName'];
		unlink($file_name);

		$this->db->query("
			DELETE i, f
			FROM `item` i
			JOIN `files` f ON i.`FileID`=f.`ID`
			WHERE i.`Id`=$id
		");
		Kernel::redirect(SITE_URL . "admin/item/all");
	}

}

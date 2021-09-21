<?php

class Model_Widget_AdminMenu extends Model {

	public function getContent($active_name) {

		$result_data = array();

		// запись данных в массив
		$result_data['Новости'] = array(
			array(
				'Name' => "news/add",
				'Label' => "Добавить новость",
				'Active' => ("news/add" == $active_name ? 1 : 0)
			),
			array(
				'Name' => "news/all",
				'Label' => "Все новости",
				'Active' => ("news/all" == $active_name ? 1 : 0)
			),
		);

		$result_data['Контент'] = array(
			array(
				'Name' => "item/add",
				'Label' => "Добавить контент",
				'Active' => ("item/add" == $active_name ? 1 : 0)
			),
			array(
				'Name' => "item/all",
				'Label' => "Весь контент",
				'Active' => ("item/all" == $active_name ? 1 : 0)
			),
		);

		$result_data['Страницы'] = array(
			array(
				'Name' => "page/add",
				'Label' => "Добавить страницу",
				'Active' => ("page/add" == $active_name ? 1 : 0)
			),
			array(
				'Name' => "page/all",
				'Label' => "Все страницы",
				'Active' => ("page/all" == $active_name ? 1 : 0)
			),
		);

		return $result_data;
	}
}

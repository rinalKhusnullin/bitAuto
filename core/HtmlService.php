<?php

namespace ES;

use ES\Model\Database\MySql;

class HtmlService
{
	public static function getHtmlTag($key, $value): ?string
	{
		$db = MySql::getInstance();
		$tags = $db->getTagList();

		$brand = $tags['brand'];
		$carcase = $tags['carcase'];
		$transmission = $tags['transmission'];

		switch ($key) {
			case 'id':
				return $value;

			case 'price':
			case 'title':
			case 'value':
			case 'fullName':
			case 'phone':
			case 'mail':
			case 'address':
			case 'comment':
			case 'status':
				return '<input class="admin-input" type="text" value=" ' . $value . ' ">';

			case 'isActive':
				return '<select> <option selected="selected">Да</option><option>Нет</option></select>';

			case 'brandType':
				$result = '<select>';
				$result .= '<option> ' . $value . '</option>';
				foreach ($brand as $item)
				{
					$result .= ($value !== $item) ? '<option> ' . $item . '</option>' : '';
				}
				$result .= '</select>';
				return $result;

			case 'carcaseType':
				$result = '<select>';
				$result .= '<option> ' . $value . '</option>';
				foreach ($carcase as $item)
				{
					$result .= ($value !== $item) ? '<option> ' . $item . '</option>' : '';
				}
				$result .= '</select>';
				return $result;

			case 'transmissionType':
				$result = '<select>';
				$result .= '<option> ' . $value . '</option>';
				foreach ($transmission as $item)
				{
					$result .= ($value !== $item) ? '<option> ' . $item . '</option>' : '';
				}
				$result .= '</select>';
				return $result;

			case 'fullDesc':
				return '<textarea rows = "10" cols="45"> ' . $value . ' </textarea>';

			case 'dateCreation':
				return $value;

			case 'dateUpdate':
				return $value;
			default:
				return $value;
		}
	}
}
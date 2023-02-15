<?php

namespace ES;

use ES\Model\Database\MySql;

class HtmlService
{
	public static function getHtmlTag($key, $value): ?string
	{
		$db = MySql::getInstance();
		$tegs = $db->getTegs();

		$brand = $tegs['brand'];
		$carcase = $tegs['carcase'];
		$transmission = $tegs['transmission'];

		switch ($key) {
			case 'id':
				return $value;

			case 'price':
			case 'title':
				return '<input class="admin-input" type="text" value=" ' . $value . ' ">';

			case 'isActive':
				return '<select> <option selected="selected">Да</option><option>Нет</option></select>';

			case 'brand':
				$result = '<select>';
				foreach ($brand as $item)
				{
					$result .= '<option> ' . $item . '</option>';
				}
				$result .= '</select>';
				return $result;

			case 'carcaseType':
				$result = '<select>';
				foreach ($carcase as $item)
				{
					$result .= '<option> ' . $item . '</option>';
				}
				$result .= '</select>';
				return $result;
				
			case 'transmission':
				$result = '<select>';
				foreach ($transmission as $item)
				{
					$result .= '<option> ' . $item . '</option>';
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


// Я тут добавил, чтобы хотя бы что то в заказах выходило
// Если кратко, то из-за того что в switch есть не все ключи, он ничего не отдает и все крашится
// добавил default чтобы если вдруг он выводил хотя бы что то, и тут встает новая проблема - в order лежит обьект продукта
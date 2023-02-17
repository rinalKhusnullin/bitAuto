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
				return "<input class='admin-input' name='$key' type='hidden' value='$value'>$value";

			case 'price':
			case 'title':
			case 'value':
			case 'fullName':
			case 'phone':
			case 'mail':
			case 'address':
			case 'comment':
			case 'status':
				return "<input name='$key' class='admin-input' type='text' value='$value'>";

			case 'isActive':
				$isActive = ($value === true) ? "<option selected value='true'>Да</option><option value='false'>Нет</option>" 
				:"<option value='true'>Да</option><option selected value='false'>Нет</option>";

				return "<select name='$key'> $isActive </select>";


			case 'brandType':
				$result = "<select name='$key'>";
				$result .= "<option>$value</option>";
				foreach ($brand as $item)
				{
					$result .= ($value !== $item) ? "<option>$item</option>" : '';
				}
				$result .= '</select>';
				return $result;

			case 'carcaseType':
				$result = "<select name='$key'>";
				$result .= "<option>$value</option>";
				foreach ($carcase as $item)
				{
					$result .= ($value !== $item) ? "<option>$item</option>" : '';
				}
				$result .= '</select>';
				return $result;

			case 'transmissionType':
				$result = "<select name='$key'>";
				$result .= "<option>$value</option>";
				foreach ($transmission as $item)
				{
					$result .= ($value !== $item) ? "<option>$item</option>" : '';
				}
				$result .= '</select>';
				return $result;

			case 'fullDesc':
				return "<textarea rows = '10' cols='45' name='$key'>$value</textarea>";

			case 'dateCreation':
				return "<input type='hidden' class='admin-input' name='$key' type='text' value='$value'>$value";

			case 'dateUpdate':
				return "<input type='hidden' class='admin-input' name='$key' type='text' value='$value'>$value";
			default:
				return $value;
		}
	}
}
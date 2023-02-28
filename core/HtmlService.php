<?php

namespace ES;

use ES\config\ConfigurationController;
use ES\Model\Database\MySql;

class HtmlService
{
	public static function getHtmlTag($key, $value, $mainImage=''): ?string
	{
		$tags = MySql::getInstance();

		$brand = $tags->getTagByName('brand');
		$carcase = $tags->getTagByName('carcase');
		$transmission = $tags->getTagByName('transmission');

		switch ($key)
		{
			case 'id':
				return "<input class='admin-input' name='$key' type='hidden' value='$value'><div class='td_value'>$value</div>";

			case 'images':
				$data = serialize($value);
				$form = "<div class='admin-images' id='js-file-list'>";
				$id = 0;

				if ($value)
				{
					foreach ($value as $image)
					{
						$isMain = $image === $mainImage ? 'checked' : '';

						$imagePathArray = explode('.', $image);
						$imagePath = implode('-thumb.', $imagePathArray);
						$form .= "<div class='img-item'><input type='hidden' name='images[]' value='{$image}'>
								<input type='radio' id='image{$id}' name='main-image' value='{$image}' style='display:none;' {$isMain}>
								<label for='image{$id}'>
									<img class='admin-img' src='/uploads/main/{$imagePath}' alt='{$image}'>
									
									<a href='#' class='delete-icon' onclick='remove_img(this); return false;'></a>
								</label></div>";
						$id++;
					}
				}



				return $form . '</div><input id="js-file" class="add-input" type="file" name="file[]" multiple accept=".jpg,.jpeg,.png,.gif">';

			case 'productId':
			case 'productPrice':
			case 'price':
			case 'title':
			case 'value':
			case 'fullName':
			case 'phone':
			case 'mail':
			case 'address':
			case 'comment':
			case 'login':
			case 'firstName':
			case 'lastName':
				return "<input name='$key' class='admin-input' type='text' value='$value'>";
			case 'password':
				return "
					<input name='password' type='password' id='show1'> 
					<button class='far fa-eye' type='button' id='show'></button>
					";
			case 'isActive':
				$isActive = ($value === true)
					? "<option selected value='true'>Да</option><option value='false'>Нет</option>"
					: "<option value='true'>Да</option><option selected value='false'>Нет</option>";

				return "<select name='$key'> $isActive </select>";

			case 'status':
				$result = "<select name='$key'>";
				foreach (ConfigurationController::getConfig('statuses') as $status)
				{
					$selected = ($status === $value) ? 'selected' : '';
					$result .= "<option $selected>$status</option>";
				}
				$result .= '</select>';
				return $result;
			case 'role':
				$result = "<select name='$key'>";
				foreach (ConfigurationController::getConfig('roles') as $role)
				{
					$selected = ($role === $value) ? 'selected' : '';
					$result .= "<option $selected>$role</option>";
				}
				$result .= '</select>';
				return $result;
			case 'brandType':
				$result = "<select name='$key'>";
				foreach ($brand as $item)
				{
					$selected = $item->value === $value ? 'selected' : '';
					$result .= "<option $selected value='$item->id'>$item->value</option>";
				}
				$result .= '</select>';
				return $result;

			case 'carcaseType':
				$result = "<select name='$key'>";
				foreach ($carcase as $item)
				{
					$selected = $item->value === $value ? 'selected' : '';
					$result .= "<option $selected value='$item->id'>$item->value</option>";
				}
				$result .= '</select>';
				return $result;

			case 'transmissionType':
				$result = "<select name='$key'>";
				foreach ($transmission as $item)
				{
					$selected = $item->value === $value ? 'selected' : '';
					$result .= "<option $selected value='$item->id'>$item->value</option>";
				}
				$result .= '</select>';
				return $result;

			case 'fullDesc':
				return "<textarea rows = '10' cols='45' name='$key'>$value</textarea>";

			case 'dateUpdate':
			case 'dateCreation':
				return "<input type='hidden' class='admin-input' name='$key' type='text' value='$value'>
					<div class='td_value'>$value</div>";

			default:
				return "<div class='td_value'>$value</div>";
		}
	}

	public static function renderAdminTable($key, $value)
	{
		switch ($key)
		{
			case 'mainImage':
			case 'images':
				return '';

			case 'password':
				return '<td>Скрыт</td>';

			case 'fullDesc':
				$shortDesc = mb_substr($value, 0, 120);
				return "<td class = 'fullDesc'>$shortDesc...<div class = 'hidden_fullDesc'> $value </div></td>";

			default:
				return "<td>$value</td>";
		}

	}

	public static function renderColumn($column)
	{
		switch ($column)
		{
			case 'mainImage':
				return '';

			default:
				return "<th class='column'>$column</th>";
		}
	}

	public static function getLink(array $args, $link = '') :string
	{
		$link .= '?';
		foreach ($args as $key => $get)
		{
			if ($key === 'page') continue;
			$link .= "$key=$get&";
		}
		return $link;
	}
}
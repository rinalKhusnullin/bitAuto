<?php

namespace ES;

class HtmlService
{
 public static function getHtmlTag($item, $key) {
	 $db= new Model\sqlDAO\sqlDB();
	 $categories = $db->getTegs();
	 foreach ($categories[0] as $category)
	 {
		 $brand[] = $category['BRAND'];
	}
	// ADD OTHER CATEGORIES PLEASE
	 switch ($key) {
		 case 'id' : return $item;

		 case 'price':
		 case 'title' : return '<input class="admin-input" type="text" value=" '. $item . ' ">';

		 case 'isActive' : return '<select> <option selected="selected">Да</option><option>Нет</option></select>';

		 case 'brand' : {
			 $result = '<select>';
			 foreach ($brand as $item) {
				 $result .= '<option> ' . $item . '</option>';
			 }
			 $result .= '</select>';
			 return $result;
		 }

		 case 'fullDesc' : return '<textarea rows = "10" cols="45"> '. $item. ' </textarea>';
	 }
 }
}
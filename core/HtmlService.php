<?php

namespace ES;

class HtmlService
{
 public static function getHtmlTag($item, $key) {
	 switch ($key) {
		 case 'id' : return $item;

		 case 'price':
		 case 'title' : return '<input class="admin-input" type="text" value=" '. $item . ' ">';

		 case 'isActive' : return '<select> <option selected="selected">Да</option><option>Нет</option></select>';

		 case 'fullDesc' : return '<textarea rows = "10" cols="45"> '. $item. ' </textarea>';
	 }
 }
}
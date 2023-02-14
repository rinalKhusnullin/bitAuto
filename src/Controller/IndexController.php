<?php

namespace ES\Controller;

use ES\config\ConfigurationController;
use ES\Model\sqlDAO\sqlDB;

class IndexController extends BaseController
{
	public function indexAction(): void
	{


		$indexPage = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
		$db = new sqlDB();
		$tags = $db->getTegs();

		if (isset($_GET['brand']) || isset($_GET['transmission']) || isset($_GET['carcase'])) //Если пользователь выбрал категории
		{
			$brand = isset($_GET['brand']) ? $_GET['brand'] : null;
			$carcase = isset($_GET['carcase']) ? $_GET['carcase'] : null;
			$transmission =  isset($_GET['transmission']) ? $_GET['transmission'] : null;

			// Возвращает массив из товаров и количества позиций
			[$products, $pageCount] = $db->getProductDataByTeg($brand, $carcase, $transmission, $indexPage);
		}
		else if (isset($_GET['search_query']))
		{
			$searchQuery = $_GET['search_query'];

			//Ищем по поисковой строке
			[$products, $pageCount] = $db->getDataBySQuery($searchQuery, $indexPage);
		}
		else
		{
			// Иначе получаем все товары
			[$products, $pageCount] = [$db->getProductData(true, $indexPage), $db->getPageCount()];
		}

		if (empty($products))
		{
			// По хорошему тут нужно вывести что товары не найдены
		}
		session_start();
		$role = array_key_exists('USER' , $_SESSION)? $_SESSION['USER']['role'] : 'user';

			$this->render('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'tags' => $tags,
			'role' => $role,
			'content' => TemplateEngine::view('pages/index', [
				'products' => $products,
				'pagination' => TemplateEngine::view('components/pagination', [
					'currentPage' => $indexPage,
					'countPage' => $pageCount,
				]),
			]),
		]);
	}
}

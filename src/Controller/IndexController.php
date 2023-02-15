<?php

namespace ES\Controller;

use ES\config\ConfigurationController;
use ES\Model\Database\MySql;

class IndexController extends BaseController
{
	public function indexAction(): void
	{


		$indexPage = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
		$db = MySql::getInstance();
		$tags = $db->getTegs();

		if (isset($_GET['brand']) || isset($_GET['transmission']) || isset($_GET['carcase'])) //Если пользователь выбрал категории
		{
			$brand = isset($_GET['brand']) ? $_GET['brand'] : null;
			$carcase = isset($_GET['carcase']) ? $_GET['carcase'] : null;
			$transmission =  isset($_GET['transmission']) ? $_GET['transmission'] : null;

			// Возвращает массив из товаров и количества позиций
			$products = $db->getProductsByTeg($brand, $carcase, $transmission, $indexPage);
			$pageCount = $db->getPageCountByTegs($brand, $carcase, $transmission);
		}
		else if (isset($_GET['search_query']))
		{
			$searchQuery = $_GET['search_query'];

			$products = $db->getPageCountByQuery($searchQuery);
			$pageCount = $db->getProductsByQuery($searchQuery, $indexPage);
		}
		else
		{
			$products = $db->getProducts($indexPage);
			$pageCount = $db->getPageCount();
		}
		if (empty($products))
		{
			// По хорошему тут нужно вывести что товары не найдены
		}
		
		session_start();
		$role = array_key_exists('USER' , $_SESSION) ? $_SESSION['USER']['role'] : 'user';

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

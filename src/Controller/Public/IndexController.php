<?php

namespace ES\Controller\Public;

use ES;
use ES\Controller\BaseController;
use ES\Model\Database\MySql;
use ES\Services\ConfigurationService;
use ES\Services\TemplateEngine;

class IndexController extends BaseController
{
	public function indexAction(): void
	{
		$indexPage = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
		$db = MySql::getInstance();
		$brands = $db->getTagByName('brand');
		$carcases = $db->getTagByName('carcase');
		$transmissions = $db->getTagByName('transmission');
		$emptyProduct = false;

		if (isset($_GET['brand']) || isset($_GET['transmission']) || isset($_GET['carcase'])) //Если пользователь выбрал категории
		{
			$brand = isset($_GET['brand']) ? $_GET['brand'] : null;
			$carcase = isset($_GET['carcase']) ? $_GET['carcase'] : null;
			$transmission =  isset($_GET['transmission']) ? $_GET['transmission'] : null;

			// Возвращает массив из товаров и количества позиций
			$products = $db->getProductsByTags($brand, $carcase, $transmission, $indexPage, 'active');
			$pageCount = $db->getPageCountByTags($brand, $carcase, $transmission, 'active');
		}
		else if (isset($_GET['search_query']))
		{
			$searchQuery = $_GET['search_query'];
			$products = $db->getProductsByQuery($searchQuery, $indexPage, 'active');
			$pageCount = $db->getPageCountByQuery($searchQuery, 'active');
		}
		else
		{
			$products = $db->getProducts($indexPage, 'active');
			$pageCount = $db->getPageCount('active');
		}
		if (empty($products))
		{
			$products = 'Товар не найден';
			$emptyProduct = true;
		}
		$products = (array)$products;
		$link = ES\Services\HtmlService::getLink($_GET);
		session_start();
		$role = array_key_exists('USER' , $_SESSION)? $_SESSION['USER']->role : 'user';

		$this->render('layout', [
			'title' => ConfigurationService::getConfig('TITLE'),
			'tags' => TemplateEngine::view('components/tags', [
				'brands' => $brands,
				'carcases' => $carcases,
				'transmissions' => $transmissions,
			]),
			'role' => $role,
			'content' => TemplateEngine::view('pages/index', [
				'products' => $products,
				'emptyProduct' => $emptyProduct,
				'pagination' => TemplateEngine::view('components/pagination', [
					'link' => $link,
					'currentPage' => $indexPage,
					'countPage' => $pageCount,
				]),
			]),
		]);
	}
}

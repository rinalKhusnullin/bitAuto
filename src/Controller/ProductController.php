<?php

namespace ES\Controller;

use ES\Model\sqlDB;

class ProductController extends BaseController
{
	public function getDetailAction($id): void
	{
		if ((int)$id === 0) 
		{
			header('Location: /error');
		}

		$db = new sqlDB();
		$product = $db->getDataByID($id);

		if (!$product) 
		{
			header('Location: /error');
		}

		
		// echo '<pre>';
		// print_r($product);
		// echo print_r($_POST);
		// echo '</pre>';
		
		$this->render('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'content' => TemplateEngine::view('Product/product-detailed', (array)$product),
		]);
	}
}
<?php

namespace ES\Controller;

use ES\Model\sqlDB;

class ProductController extends BaseController
{
	public function getDetailAction(int $id): void
	{
		$db = new sqlDB();
		$product = $db->getDataByID($id);

		$this->render('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'content' => TemplateEngine::view('Product/product-detailed', ['product' => $product,]),
		]);
	}
}
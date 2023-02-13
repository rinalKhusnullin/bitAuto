<?php

namespace ES\Controller;
use ES\Model\sqlDAO\sqlDB;

class AdminController extends BaseController
{
	public function adminAction() : void
	{
		$products = new sqlDB();
		$product1 = $products->getProductDataByID(1);
		$columns = array_keys((array)$product1);

		$this->render('adminPanelLayout',[
			'title' => 'admin',
			'table' => TemplateEngine::view('adminPanelLayout', [
				'columns' => $columns,
				'content' => $product1,
			]),
		]);
	}
}
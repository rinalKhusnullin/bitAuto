<?php

namespace ES\Controller;
use ES\Model\sqlDAO\sqlDB;

class AdminController extends BaseController
{
	public function adminAction() : void
	{
		$products = new sqlDB();
		$product1 = $products->getProductData(false);
		$columns = array_keys((array)$product1[0]);

		$this->render('adminPanelLayout',[
			'title' => 'admin',
			'content' => \ES\Controller\TemplateEngine::view('pages/adminTable' ,
				[
					'columns' => $columns ,
					'content' => TemplateEngine::view('components/adminTableRows',
						[
							'content' => $product1,
							'pagination' => TemplateEngine::view('components/pagination', [
								'currentPage' => $indexPage,
								'countPage' => $pageCount,
							]),
						])
				]
			)
		]);
	}
}
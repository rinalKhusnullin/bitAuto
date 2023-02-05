<?php

namespace ES\Controller;

use ES\Model\sqlDB;

class IndexController
{
	public function indexAction(): void
	{
		$indexPage = (isset($_GET['page']))? (int)$_GET['page']: 1;

		$db = new sqlDB();
		$products = $db->getData($indexPage);

		$this->render('layout', [
			'title' => Option::getConfig('TITLE'),
			'content' => TemplateEngine::view('pages/index', ['products' => $products,]),
			'pagination' => TemplateEngine::view('components/pagination', []),
		]);
	}
}

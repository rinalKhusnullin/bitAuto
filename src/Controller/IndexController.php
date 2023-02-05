<?php

namespace ES\Controller;

use ES\Model\sqlDB;

class IndexController extends BaseController
{
	public function indexAction(): void
	{
		$indexPage = (isset($_GET['page']))? (int)$_GET['page']: 0;

		$db = new sqlDB();
		$products = $db->getData($indexPage);

		$this->render('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'content' => TemplateEngine::view('pages/index', [
				'products' => $products,
				'pagination' => TemplateEngine::view('components/pagination', []),
				]),
		]);
	}
}

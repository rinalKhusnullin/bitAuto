<?php

namespace ES\Controller;

use ES\Model\Order;
use ES\Model\sqlDB;

class ProductController extends BaseController
{
	public function getDetailAction($id): void
	{
		(is_numeric($id)) ? $id = (int)$id : header('Location: /error');

		$db = new sqlDB();
		$product = $db->getDataByID((int)$id);

		if ($product === null)
		{
			header('Location: /error');
		}

		if (!empty($_POST))
		{
			$db->createOrder(new Order(
				$_POST['userLastname'],
				$_POST["userName"],
				$_POST["userTel"],
				$_POST["userEmail"],
				$_POST["userAddress"],
				$_POST["userComment"],
				$product,
				date('Y-m-d H:i:s')
			));

			header('Location: /byed');
		}

		$this->render('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'content' => TemplateEngine::view('Product/product-detailed', (array)$product),
		]);
	}
}
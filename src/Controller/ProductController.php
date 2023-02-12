<?php

namespace ES\Controller;

use ES\Model\Order;
use ES\Model\sqlDAO\sqlDB;
use ES\config\ConfigurationController;

class ProductController extends BaseController
{
	public function getDetailAction($id): void
	{
		$db = new sqlDB();
		$product = $db->getProductDataByID((int)$id);

		if ($product === null)
		{
			header('Location: /error/');
		}

		$this->render('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'content' => TemplateEngine::view('Product/product-detailed', (array)$product)
		]);
	}
	public function postDetailAction($id): void
	{
		$db = new sqlDB();
		$product = $db->getProductDataByID((int)$id);

		if ($product === null)
		{
			header('Location: /error/');
		}

		if (!empty($_POST)) // its not working
		{
			$result = $db->createOrder(new Order(
				$_POST['userLastname'],
				$_POST["userName"],
				$_POST["userTel"],
				$_POST["userEmail"],
				$_POST["userAddress"],
				$_POST["userComment"],
				$product,
				date('Y-m-d H:i:s')
			));
			$result ? header('Location: /success/') : header('Location: /failed/');
		}
		else
		{
			header("Location: /product/$product->id/");
		}
	}
}

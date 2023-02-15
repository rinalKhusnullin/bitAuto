<?php

namespace ES\Controller;

use ES\Model\Order;
use ES\config\ConfigurationController;
use ES\Model\Database\MySql;

class ProductController extends BaseController
{
	public function getDetailAction($id): void
	{
		$db = MySql::getInstance();
		$product = $db->getProductByID((int)$id);
		$tags = $db->getTegs();

		if ($product === null)
		{
			header('Location: /error/');
		}
		session_start();
		$role = array_key_exists('USER' , $_SESSION)? $_SESSION['USER']['role'] : 'user';
		$this->render('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'role' => $role,
			'tags' => $tags,
			'content' => TemplateEngine::view('Product/product-detailed', (array)$product)
		]);
	}
	public function postDetailAction($id): void
	{
		$db = MySql::getInstance();
		$product = $db->getProductByID((int)$id);

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

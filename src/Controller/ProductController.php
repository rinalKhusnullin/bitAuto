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
		$tags = $db->getTagList();

		if ($product === null)
		{
			http_response_code(404);
			header('Location: /error/');
		}
		session_start();
		$role = array_key_exists('USER' , $_SESSION) ? $_SESSION['USER']->role : 'user';
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
			http_response_code(404);
			header('Location: /error/');
		}

		if (!empty($_POST['userLastname']) && !empty($_POST['userName']) && !empty($_POST['userTel'])
			&& !empty($_POST['userEmail']) && !empty($_POST['userAddress'])) // КОСТЫЛЬЬЬ
		{
			$result = $db->createOrder(new Order(
				$_POST['userLastname'],
				$_POST["userName"],
				$_POST["userTel"],
				$_POST["userEmail"],
				$_POST["userAddress"],
				$_POST["userComment"],
				$product->id,
				$product->price,
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

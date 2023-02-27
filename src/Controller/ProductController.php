<?php

namespace ES\Controller;

use ES\HtmlService;
use ES\Model\Order;
use ES\config\ConfigurationController;
use ES\Handler\Handler;
use ES\Model\Database\MySql;

class ProductController extends BaseController
{
	public function getDetailAction($id, $errors = []): void
	{
		$db = MySql::getInstance();
		$product = $db->getProductByID((int)$id);
		$brands = $db->getTagByName('brand');
		$carcases = $db->getTagByName('carcase');
		$transmissions = $db->getTagByName('transmission');

		if ($product === null)
		{
			http_response_code(404);
			header('Location: /error/');
		}

		$data = (array)$product;
		$data['slider'] = TemplateEngine::view('components/slider', [
			'id' => $id,
			'images' => $product->images,
		]);
		$data['errors'] = $errors;

		session_start();
		$role = array_key_exists('USER', $_SESSION) ? $_SESSION['USER']->role : 'user';

		$this->render('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'role' => $role,
			'tags' => TemplateEngine::view('components/tags', [
				'brands' => $brands,
				'carcases' => $carcases,
				'transmissions' => $transmissions,
			]),
			'content' => TemplateEngine::view('Product/product-detailed', $data),
		]);
	}

	public function postDetailAction($id): void
	{
		session_start();
		$token = filter_input(INPUT_POST, 'token',);

		if (!$token || $token !== $_SESSION['token']) {
			header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
			exit;
		}

		$db = MySql::getInstance();
		$product = $db->getProductByID((int)$id);

		if ($product === null)
		{
			http_response_code(404);
			header('Location: /error/');
		}

		$errors = Handler::handleOrder(
			$_POST['userFullname'],
			$_POST['userTel'],
			$_POST['userEmail'],
			$_POST['userAddress'],
			$_POST['userComment']
		);

		if (empty($errors))
		{
			$result = $db->createOrder(new Order(
				1,
				$_POST['userFullname'],
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
			$this->getDetailAction($product->id, $errors);
		}
	}
}

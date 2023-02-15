<?php

namespace ES\Controller;

use ES\Model\Database\MySql;

class AdminController extends BaseController
{
	public function adminAction() : void
	{
		session_start();
		if (!isset($_SESSION['USER']))
		{
			header('Location: /login/');
		}

		$indexPage = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
		$db = MySql::getInstance();

		if (isset($_GET['products']))
		{
			$content = $db->getProducts($indexPage, 'all');
			$columns = array_keys((array)$content[0]);
		}
		elseif(isset($_GET['orders']))
		{
			$content = $db->getOrders();
			$columns = array_keys((array)$content[0]);
		}
		elseif (isset($_GET['users']))
		{
			$content = $db->getUsers();
			$columns = array_keys((array)$content[0]);
		}
		elseif (isset($_GET['brands']))
		{
			
			$content = $db->getBrands();
			$columns = array_keys((array)$content[0]);
		}
		elseif (isset($_GET['carcases']))
		{
			$content = $db->getCarcases();
			$columns = array_keys((array)$content[0]);
		}
		elseif (isset($_GET['transmissions']))
		{
			$content = $db->getTransmissions();
			$columns = array_keys((array)$content[0]);
		}
		elseif (isset($_GET['config']))
		{
			$content[] = include ROOT . '/core/config/config.php';
			$columns = array_keys($content[0]);
		}
		else
		{
			$columns = '';
			$content = 'Выберите пункт меню';
		}

		$this->render('adminPanelLayout',[
			'title' => 'admin',
			'content' => \ES\Controller\TemplateEngine::view('pages/adminTable' ,
				[
					'columns' => $columns ,
					'content' => TemplateEngine::view('components/adminTableRows',
						[
							'content' => $content,
							'pagination' => TemplateEngine::view('components/pagination', [
								'currentPage' => '$indexPage',
								'countPage' => '$pageCount',
							]),
						])
				]
			)
		]);

	}

	public function adminEditAction () :void
	{
		session_start();
		if (!isset($_SESSION['USER']))
		{
			header('Location: /login/');
		}

		$indexPage = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
		$db = MySql::getInstance();
		$tegs = $db->getTagList();

		if (array_key_exists('product', $_GET))
		{
			$content = $db->getProductByID($_GET['product']); // @TODO ЭКРАНИРОВАНИЕ!!!!!
			$columns = array_keys((array)$content);
		}
		elseif(array_key_exists('order', $_GET))
		{
			$content = $db->getOrderById($_GET['order']);
			$columns = array_keys((array)$content);
		}
		elseif (array_key_exists('user', $_GET))
		{
			$content = $db->getUserById($_GET['user']);
			$columns = array_keys((array)$content);
		}
		elseif (array_key_exists('brand', $_GET))
		{

			$content = $db->getBrandById($_GET['brand']);
			$columns = array_keys((array)$content);
		}
		elseif (array_key_exists('carcase', $_GET))
		{
			$content = $db->getCarcaseById($_GET['carcase']);
			$columns = array_keys((array)$content);
		}
		elseif (array_key_exists('transmission', $_GET))
		{
			$content = $db->getTransmissionById($_GET['transmission']);
			$columns = array_keys((array)$content);
		}
		elseif (isset($_GET['config']))
		{
			$content = include ROOT . '/core/config/config.php';
			$columns = array_keys($content);
		}
		else
		{
			$columns = '';
			$content = 'Выберите пункт меню';
		}

		$this->render('adminPanelLayout',[
			'title' => 'admin',
			'content' => \ES\Controller\TemplateEngine::view('pages/adminEdit' ,
				[
					'columns' => $columns ,
					'content' => TemplateEngine::view('components/adminEditRows',
						[
							'content' => $content,
							'tegs' => $tegs,
							'pagination' => TemplateEngine::view('components/pagination', [
								'currentPage' => '$indexPage',
								'countPage' => '$pageCount',
							]),
						])
				]
			)
		]);
	}
}
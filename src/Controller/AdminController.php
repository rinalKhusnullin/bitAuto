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

		$pageCount = 0;

		if (isset($_GET['products']))
		{
			$content = $db->getProducts($indexPage, 'all');
			$columns = array_keys((array)$content[0]);
			$pageCount = $db->getPageCount('all');
		}
		elseif(isset($_GET['orders']))
		{
			$content = $db->getOrders();
			$columns = array_keys((array)$content[0]);
			$pageCount = $db->getPageCount('',"`order`");
		}
		elseif (isset($_GET['users']))
		{
			$content = $db->getUsers();
			$columns = array_keys((array)$content[0]);
			$pageCount = $db->getPageCount('','user');
		}
		elseif (isset($_GET['brands']))
		{
			$content = $db->getTags('Brand');
			$columns = array_keys((array)$content[0]);
			$pageCount = $db->getPageCount('','brand');
		}
		elseif (isset($_GET['carcases']))
		{
			$content = $db->getTags('Carcase');
			$columns = array_keys((array)$content[0]);
			$pageCount = $db->getPageCount('','carcase');
		}
		elseif (isset($_GET['transmissions']))
		{
			$content = $db->getTags('Transmission');
			$columns = array_keys((array)$content[0]);
			$pageCount = $db->getPageCount('','transmission');
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
					'pagination' => TemplateEngine::view('components/Pagination', [
						'link' => '/admin/?',
						'currentPage' => $indexPage,
						'countPage' => $pageCount,
					]),
					'content' => TemplateEngine::view('components/adminTableRows',
						[
							'content' => $content,

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
			$content = $db->getProductByID($_GET['product']); //@Todo сделать эксейп
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

			$content = $db->getTagById($_GET['brand'], 'Brand');
			$columns = array_keys((array)$content);
		}
		elseif (array_key_exists('carcase', $_GET))
		{
			$content = $db->getTagById($_GET['carcase'], 'Carcase');
			$columns = array_keys((array)$content);
		}
		elseif (array_key_exists('transmission', $_GET))
		{
			$content = $db->getTagById($_GET['transmission'], 'Transmission');
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
						])
				]
			)
		]);
	}



	public function adminDeleteAction () :void
	{
		$table = array_key_first($_GET);
		$id = $_GET[$table];
		$db = MySql::getInstance();
		$db->deleteItem($table, $id);

	}
}
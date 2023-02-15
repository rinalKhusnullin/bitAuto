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
		$tegs = $db->getTegs();

		if (isset($_GET['products']))
		{
			$content = $db->getProductsForAdmin();
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
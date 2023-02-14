<?php

namespace ES\Controller;
use ES\Model\sqlDAO\sqlDB;

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
		$db = new sqlDB;
		$tegs = $db->getTegs();

		if (isset($_GET['products']))
		{
			$content = $db->getProductData(false);
			$columns = array_keys((array)$content[0]);
		}
		elseif(isset($_GET['orders']))
		{
			$columns = '';
			$content = 'ЗАКАЗЫ';
		}
		elseif (isset($_GET['users']))
		{
			$columns = '';
			$content = 'МЕШКИ ДЕНЕГ';
		}
		elseif (isset($_GET['brands']))
		{
			$columns = '';
			$content = 'БИБИКИ';
		}
		elseif (isset($_GET['carcases']))
		{
			$columns = '';
			$content = 'каркасссы';
		}
		elseif (isset($_GET['transmissions']))
		{
			$columns = '';
			$content = 'КПППППППППППП';
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
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
		$deleteMessage = [];
		$tableName = '';

		$pageCount = 0;

		if (isset($_GET['products']))
		{
			$content = $db->getProducts($indexPage, 'all');
			$columns = (!empty($content)) ? array_keys((array)$content[0]) : '';
			$pageCount = $db->getPageCount('all');
			$tableName = 'Продукция';
		}
		elseif(isset($_GET['orders']))
		{
			$content = $db->getOrders();
			$columns = (!empty($content)) ? array_keys((array)$content[0]) : '';
			$pageCount = $db->getPageCount('',"`order`");
			$tableName = 'Заказы';
		}
		elseif (isset($_GET['users']))
		{
			$content = $db->getUsers();
			$columns = (!empty($content)) ? array_keys((array)$content[0]) : '';
			$pageCount = $db->getPageCount('','user');
			$tableName = 'Пользователи';
		}
		elseif (isset($_GET['brands']))
		{
			$content = $db->getTags('Brand');
			$columns = (!empty($content)) ? array_keys((array)$content[0]) : '';
			$pageCount = $db->getPageCount('','brand');
			$tableName = 'Бренды';
		}
		elseif (isset($_GET['carcases']))
		{
			$content = $db->getTags('Carcase');
			$columns = (!empty($content)) ? array_keys((array)$content[0]) : '';
			$pageCount = $db->getPageCount('','carcase');
			$tableName = 'Кузов';
		}
		elseif (isset($_GET['transmissions']))
		{
			$content = $db->getTags('Transmission');
			$columns = (!empty($content)) ? array_keys((array)$content[0]) : '';
			$pageCount = $db->getPageCount('','transmission');
			$tableName = 'Коробка передач';
		}
		else
		{
			$columns = '';
			$content = 'Выберите пункт меню';
			$tableName = '';
		}

		if (empty($content))
		{
			$content = "Тут ничего нет";
			$columns = '';
			$pageCount = 0;
			$tableName = '';
		}

		if (isset($_GET['delete']))
		{
			$deleteMessage[] = "Элеиент id = {$_GET['delete']} успешно уданел";
		}

		$this->render('admin-panel-layout',[
			'title' => 'admin',
			'content' => \ES\Controller\TemplateEngine::view('pages/admin-table' ,
				[
					'tableName' => $tableName,
					'columns' => $columns ,
					'deleteMessage' => $deleteMessage,
					'pagination' => TemplateEngine::view('components/pagination', [
						'link' => '/admin/?',
						'currentPage' => $indexPage,
						'countPage' => $pageCount,
					]),
					'content' => TemplateEngine::view('components/admin-table-rows',
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
			$content = $db->getProductByID($_GET['product']);
			$tableName = 'продукции';
			$className = 'Product';
		}
		elseif(array_key_exists('order', $_GET))
		{
			$content = $db->getOrderById($_GET['order']);
			$tableName = 'заказов';
			$className = 'Order';
		}
		elseif (array_key_exists('user', $_GET))
		{
			$content = $db->getUserById($_GET['user']);
			$tableName = 'пользователей';
			$className = 'User';
		}
		elseif (array_key_exists('brand', $_GET))
		{

			$content = $db->getTagById($_GET['brand'], 'Brand');
			$tableName = 'брендов';
			$className = 'Brand';
		}
		elseif (array_key_exists('carcase', $_GET))
		{
			$content = $db->getTagById($_GET['carcase'], 'Carcase');
			$tableName = 'кузовов';
			$className = 'Carcase';
		}
		elseif (array_key_exists('transmission', $_GET))
		{
			$content = $db->getTagById($_GET['transmission'], 'Transmission');
			$tableName = 'коробок передач';
			$className = 'Transmission';
		}
		else
		{
			$content = 'Выберите пункт меню';
			$className = '';
			$tableName = '';
		}
		$columns = array_keys((array)$content) ?: '' ;

		$this->render('admin-panel-layout',[
			'title' => 'admin',
			'content' => \ES\Controller\TemplateEngine::view('pages/admin-edit' ,
				[
					'tableName' => $tableName,
					'columns' => $columns ,
					'content' => TemplateEngine::view('components/admin-edit-rows',
						[
							'content' => $content,
							'tegs' => $tegs,
							'className' => $className,
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

	public function adminChangeItem() : void
	{
		if (array_key_exists('item', $_POST))
		{
			if ($_POST['item'] === 'Product')
			{
				$changedProduct = new \ES\Model\Product(
					$_POST['id'],
					$_POST['title'],
					$_POST['isActive'],
					$_POST['brandType'],
					$_POST['transmissionType'],
					$_POST['carcaseType'],
					$_POST['dateCreation'],
					date('Y-m-d H:i:s'),
					$_POST['fullDesc'],
					$_POST['price']
				);
				if ((MySql::getInstance())->updateProduct($changedProduct))
				{
					$this->render('admin-panel-layout',[
						'title' => 'admin',
						'content' => '<h1> Товар успешно изменен. </h1>',
					]);
				}
			}
			elseif ($_POST['item'] === 'User')
			{
				echo "Тут что то происходит с user";
			}
			else if ($_POST['item'] === 'Brand' || $_POST['item'] === 'carcase' || $_POST['item'] === 'Transmission')
			{
				echo "Тут что то происходит с Tag";
			}
			else if ($_POST['item'] === 'Order')
			{
				$changedOrder = new \ES\Model\Order(
					$_POST['id'],
					$_POST['fullName'],
					$_POST['phone'],
					$_POST['mail'],
					$_POST['address'],
					$_POST['comment'],
					$_POST['productId'],
					$_POST['productPrice'],
					$_POST['dateCreation'],
					$_POST['status']
				);
				if ((MySql::getInstance())->updateOrder($changedOrder))
				{
					echo "Заказ изменен";
				}
			};

		}
	}

	public function adminAddAction()
	{
		if (array_key_exists('product', $_GET))
		{
			$content = get_class_vars(Product::class);
			$className = 'Product';
			$tableName = 'продукции';
		}
		elseif(array_key_exists('order', $_GET))
		{
			$content = get_class_vars(Order::class);
			$className = 'Order';
			$tableName = 'заказов';
		}
		elseif (array_key_exists('user', $_GET))
		{
			$content = $db->getUserById($_GET['user']);
			$tableName = 'пользователей';
		}
		elseif (array_key_exists('brand', $_GET))
		{

			$content = $db->getTagById($_GET['brand'], 'Brand');
			$tableName = 'брендов';
		}
		elseif (array_key_exists('carcase', $_GET))
		{
			$content = $db->getTagById($_GET['carcase'], 'Carcase');
			$tableName = 'кузовов';
		}
		elseif (array_key_exists('transmission', $_GET))
		{
			$content = $db->getTagById($_GET['transmission'], 'Transmission');
			$tableName = 'коробок передач';
		}
		else
		{
			$content = 'Выберите пункт меню';
			$tableName = '';
		}
		$columns = array_keys((array)$content) ?: '' ;
		$db = MySql::getInstance();
		$tegs = $db->getTagList();

		$this->render('admin-panel-layout',[
			'title' => 'admin',
			'content' => \ES\Controller\TemplateEngine::view('pages/admin-edit' ,
				[
					'tableName' => $tableName,
					'columns' => $columns ,
					'content' => TemplateEngine::view('components/admin-edit-rows',
						[
							'content' => $content,
							'tegs' => $tegs,
							'className' => $className,
						])
				]
			)
		]);
	}

	function adminAddItem() {
		if (array_key_exists('item', $_POST))
		{
			if ($_POST['item'] === 'Product')
			{
				$changedProduct = new \ES\Model\Product(
					$_POST['id'],
					$_POST['title'],
					$_POST['isActive'],
					$_POST['brandType'],
					$_POST['transmissionType'],
					$_POST['carcaseType'],
					$_POST['dateCreation'],
					date('Y-m-d H:i:s'),
					$_POST['fullDesc'],
					$_POST['price']
				);
				if ((MySql::getInstance())->updateProduct($changedProduct))
				{
					$this->render('admin-panel-layout',[
						'title' => 'admin',
						'content' => '<h1> Товар успешно изменен. </h1>',
					]);
				}
			}
			elseif ($_POST['item'] === 'User')
			{
				echo "Тут что то происходит с user";
			}
			else if ($_POST['item'] === 'Brand' || $_POST['item'] === 'carcase' || $_POST['item'] === 'Transmission')
			{
				echo "Тут что то происходит с Tag";
			}
			else if ($_POST['item'] === 'Order')
			{
				$changedOrder = new \ES\Model\Order(
					1,
					$_POST['fullName'],
					$_POST['phone'],
					$_POST['mail'],
					$_POST['address'],
					$_POST['comment'],
					$_POST['productId'],
					$_POST['productPrice'],
					$_POST['dateCreation'],
					$_POST['status']
				);
				if ((MySql::getInstance())->createOrder($changedOrder))
				{
					$this->render('admin-panel-layout',[
						'title' => 'admin',
						'content' => '<h1> Заказ создан. </h1>',
					]);
				}
			};
		}

	}
}
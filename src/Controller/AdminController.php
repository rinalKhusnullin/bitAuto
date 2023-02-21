<?php

namespace ES\Controller;

use ES\Model\Database\MySql;
use ES\Model\Order;
use ES\Model\Product;
use ES\Model\Tags\Brand;
use ES\Model\Tags\Carcase;
use ES\Model\Tags\Transmission;
use ES\Model\User;

class AdminController extends BaseController
{

	public function adminAction() : void
	{
		session_start();
		if (!isset($_SESSION['USER']))
		{
			header('Location: /login/');
		}
		$role = $_SESSION['USER'] ->role;

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
			$addItemLink = 'product';
		}
		elseif(isset($_GET['orders']))
		{
			$content = $db->getOrders();
			$columns = (!empty($content)) ? array_keys((array)$content[0]) : '';
			$pageCount = $db->getPageCount('',"`order`");
			$tableName = 'Заказы';
			$addItemLink = 'order';
		}
		elseif (isset($_GET['users']))
		{
			$content = $db->getUsers();
			$columns = (!empty($content)) ? array_keys((array)$content[0]) : '';
			$pageCount = $db->getPageCount('','user');
			$tableName = 'Пользователи';
			$addItemLink = 'user';
		}
		elseif (isset($_GET['brands']))
		{
			$content = $db->getTags('Brand');
			$columns = (!empty($content)) ? array_keys((array)$content[0]) : '';
			$pageCount = $db->getPageCount('','brand');
			$tableName = 'Бренды';
			$addItemLink = 'brand';
		}
		elseif (isset($_GET['carcases']))
		{
			$content = $db->getTags('Carcase');
			$columns = (!empty($content)) ? array_keys((array)$content[0]) : '';
			$pageCount = $db->getPageCount('','carcase');
			$tableName = 'Кузов';
			$addItemLink = 'carcase';
		}
		elseif (isset($_GET['transmissions']))
		{
			$content = $db->getTags('Transmission');
			$columns = (!empty($content)) ? array_keys((array)$content[0]) : '';
			$pageCount = $db->getPageCount('','transmission');
			$tableName = 'Коробка передач';
			$addItemLink = 'transmission';
		}
		else
		{
			$columns = '';
			$content = 'Выберите пункт меню';
			$tableName = '';
			$addItemLink = '';
		}

		if (empty($content))
		{
			$content = "Тут ничего нет";
			$columns = '';
			$pageCount = 0;
			$tableName = '';
			$addItemLink = '';
		}

		if (isset($_GET['delete']))
		{
			$deleteMessage[] = "Элеиент id = {$_GET['delete']} успешно уданел";
		}

		$this->render('admin-panel-layout',[
			'title' => 'admin',
			'role' => $role,
			'content' => \ES\Controller\TemplateEngine::view('pages/admin-table' ,
				[
					'addItemLink' => $addItemLink,
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
		$role = $_SESSION['USER'] ->role;

		$indexPage = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
		$db = MySql::getInstance();
		$tegs = $db->getTagList();

		if (array_key_exists('product', $_GET))
		{
			$content = $db->getProductByID($_GET['product']);
			$columns = array_keys((array)$content);
			$tableName = 'Продукция';
			$className = 'Product';
		}
		elseif(array_key_exists('order', $_GET))
		{
			$content = $db->getOrderById($_GET['order']);
			$columns = array_keys((array)$content);
			$tableName = 'Заказы';
			$className = 'Order';
		}
		elseif (array_key_exists('user', $_GET))
		{
			if ($_SESSION['USER']->role!=='admin')
			{
				$this->render('admin-panel-layout',[
					'title' => 'admin',
					'role' => $role,
					'content' => '<h1> Недостаточно прав </h1>',
				]);
				exit;
			}
			$content = $db->getUserById($_GET['user']);
			$columns = array_keys((array)$content);
			$tableName = 'Пользователи';
			$className = 'User';
		}
		elseif (array_key_exists('brand', $_GET))
		{

			$content = $db->getTagById($_GET['brand'], 'Brand');
			$columns = array_keys((array)$content);
			$tableName = 'Бренды';
			$className = 'Brand';
		}
		elseif (array_key_exists('carcase', $_GET))
		{
			$content = $db->getTagById($_GET['carcase'], 'Carcase');
			$columns = array_keys((array)$content);
			$tableName = 'Кузова';
			$className = 'Carcase';
		}
		elseif (array_key_exists('transmission', $_GET))
		{
			$content = $db->getTagById($_GET['transmission'], 'Transmission');
			$columns = array_keys((array)$content);
			$tableName = 'КПП';
			$className = 'Transmission';
		}
		else
		{
			$columns = '';
			$content = 'Выберите пункт меню';
			$className = '';
			$tableName = '';
		}
		$columns = array_keys((array)$content) ?: '' ;

		$this->render('admin-panel-layout',[
			'title' => 'admin',
			'role' => $role,
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
		session_start();
		$role = $_SESSION['USER'] ->role;
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
						'role' => $role,
						'content' => '<h1> Данные изменены </h1>',
					]);
				}
			}
			elseif ($_POST['item'] === 'User')
			{
				$password = $_POST['password'] ?: MySql::getInstance()->getUserById($_GET['user'])->password;
				$changedUser = new User(
					$_POST['id'],
					$password,
					$_POST['login'],
					$_POST['mail'],
					$_POST['role'],
					$_POST['firstName'],
					$_POST['lastName']
				);

				if((MySql::getInstance())->updateUser($changedUser))
				{
					$this->render('admin-panel-layout',[
						'title' => 'admin',
						'role' => $role,
						'content' => '<h1> Данные изменены </h1>',
					]);
				}
			}
			else if ($_POST['item'] === 'Brand' || $_POST['item'] === 'Carcase' || $_POST['item'] === 'Transmission')
			{
				$id = (int)$_POST['id'];
				$value = $_POST['value'];
				$tag = $_POST['item'];
				if ($id <= 0)
				{
					header ('Location: /admin/');
				}
				if ((MySql::getInstance())->updateTags($tag,$id,$value))
				{
					$this->render('admin-panel-layout',[
						'title' => 'admin',
						'role' => $role,
						'content' => '<h1> Данные изменены </h1>',
					]);
				}
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
					$this->render('admin-panel-layout',[
						'title' => 'admin',
						'role' => $role,
						'content' => '<h1> Данные изменены </h1>',
					]);
				}
			};

		}
	}

	public function adminAddAction()
	{
		session_start();
		$role = $_SESSION['USER'] ->role;
		if (array_key_exists('product', $_GET))
		{
			$content = get_class_vars(Product::class);
			$className = 'Product';
			$tableName = 'Продукция';
		}
		elseif(array_key_exists('order', $_GET))
		{
			$content = get_class_vars(Order::class);
			$className = 'Order';
			$tableName = 'Заказы';
		}
		elseif (array_key_exists('user', $_GET))
		{
			if ($_SESSION['USER']->role!=='admin')
			{
				$this->render('admin-panel-layout',[
					'title' => 'admin',
					'role' => $role,
					'content' => '<h1> Недостаточно прав </h1>',
				]);
				exit;
			}
			$content = get_class_vars(User::class);
			$className = 'User';
			$tableName = 'Пользователи';
		}
		elseif (array_key_exists('brand', $_GET))
		{

			$content = get_class_vars(Brand::class);
			$className = 'Brand';
			$tableName = 'Бренды';
		}
		elseif (array_key_exists('carcase', $_GET))
		{
			$content = get_class_vars(Carcase::class);
			$className = 'Carcase';
			$tableName = 'Кузова';
		}
		elseif (array_key_exists('transmission', $_GET))
		{
			$content = get_class_vars(Transmission::class);
			$className = 'Transmission';
			$tableName = 'КПП';
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
			'role' => $role,
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

	function adminAddItem()
	{
		session_start();
		$role = $_SESSION['USER'] ->role;
		if (array_key_exists('item', $_POST))
		{
			if ($_POST['item'] === 'Product')
			{
				$changedProduct = new \ES\Model\Product(
					1,
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
				if ((MySql::getInstance())->createProduct($changedProduct))
				{
					$this->render('admin-panel-layout',[
						'title' => 'admin',
						'role' => $role,
						'content' => '<h1> Данные добавлены </h1>',
					]);
				}
			}
			elseif ($_POST['item'] === 'User')
			{
				$password = $_POST['password'] ?: MySql::getInstance()->getUserById($_GET['user'])->password;
				$changedUser = new User(
					1,
					$password,
					$_POST['login'],
					$_POST['mail'],
					$_POST['role'],
					$_POST['firstName'],
					$_POST['lastName']
				);
				if((MySql::getInstance())->createUser($changedUser))
				{
					$this->render('admin-panel-layout',[
						'title' => 'admin',
						'role' => $role,
						'content' => '<h1> Данные изменены </h1>',
					]);
				}
			}
			else if ($_POST['item'] === 'Brand' || $_POST['item'] === 'Carcase' || $_POST['item'] === 'Transmission')
			{
				$value = $_POST['value'];
				$tag = $_POST['item'];

				if ((MySql::getInstance())->createTags($tag, $value))
				{
					$this->render('admin-panel-layout',[
						'title' => 'admin',
						'role' => $role,
						'content' => '<h1> Данные добавлены </h1>',
					]);
				}
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
						'role' => $role,
						'content' => '<h1> Данные добавлены </h1>',
					]);
				}
			};
		}

	}
}
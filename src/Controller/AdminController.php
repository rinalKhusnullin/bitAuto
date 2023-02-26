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
			unset($columns[(int)array_key_last($columns)]);
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
			$content = $db->getTagByName('Brand');
			$columns = (!empty($content)) ? array_keys((array)$content[0]) : '';
			$pageCount = $db->getPageCount('','brand');
			$tableName = 'Бренды';
			$addItemLink = 'brand';
		}
		elseif (isset($_GET['carcases']))
		{
			$content = $db->getTagByName('Carcase');
			$columns = (!empty($content)) ? array_keys((array)$content[0]) : '';
			$pageCount = $db->getPageCount('','carcase');
			$tableName = 'Кузов';
			$addItemLink = 'carcase';
		}
		elseif (isset($_GET['transmissions']))
		{
			$content = $db->getTagByName('Transmission');
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

		$db = MySql::getInstance();
		$_SESSION['token'] = md5(uniqid(mt_rand(), true));

		if (array_key_exists('product', $_GET))
		{
			$content = $db->getProductByID($_GET['product']);
			$tableName = 'Продукция';
			$className = 'product';
		}
		elseif(array_key_exists('order', $_GET))
		{
			$content = $db->getOrderById($_GET['order']);
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
			$tableName = 'Пользователи';
			$className = 'User';
		}
		elseif (array_key_exists('brand', $_GET))
		{

			$content = $db->getTagById($_GET['brand'], 'Brand');
			$tableName = 'Бренды';
			$className = 'Brand';
		}
		elseif (array_key_exists('carcase', $_GET))
		{
			$content = $db->getTagById($_GET['carcase'], 'Carcase');
			$tableName = 'Кузова';
			$className = 'Carcase';
		}
		elseif (array_key_exists('transmission', $_GET))
		{
			$content = $db->getTagById($_GET['transmission'], 'Transmission');
			$tableName = 'КПП';
			$className = 'Transmission';
		}
		else
		{
			$content = 'Выберите пункт меню';
			$className = '';
			$tableName = '';
		}
		$content = (array)$content;
		$columns = array_keys($content) ?: '' ;

		$this->render('admin-panel-layout',[
			'title' => 'admin',
			'role' => $role,
			'content' => \ES\Controller\TemplateEngine::view('pages/admin-edit' ,
				[
					'tableName' => $tableName,
					'columns' => $columns ,
					'className' => $className,
					'len' => count($columns),
					'content' => $content,
				]
			)
		]);
	}



	public function adminDeleteAction () :void
	{
		session_start();
		if (!isset($_SESSION['USER']))
		{
			header('Location: /login/');
		}

		$token = filter_input(INPUT_POST, 'token',);

		if (!$token || $token !== $_SESSION['token']) {
			header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
			exit;
		}

		$table = $_POST['table'];
		$id = $_POST['id'];
		$db = MySql::getInstance();
		$db->deleteItem($table, $id);
	}

	//eeee
	public function adminChangeItem() : void
	{
		session_start();
		$token = filter_input(INPUT_POST, 'token',);
		$role = $_SESSION['USER'] ->role;

		if (!$token || $token !== $_SESSION['token']) {
			header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
			exit;
		}

		if (array_key_exists('item', $_POST))
		{
			if ($_POST['item'] === 'product')
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
					$_POST['price'],
					$_POST['main-image'] ?? '',
					$_POST['images'] ?? []
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
			}
		}
	}

	public function adminAddAction()
	{
		session_start();
		$role = $_SESSION['USER'] ->role;
		if (array_key_exists('product', $_GET))
		{
			$content = get_class_vars(Product::class);
			$className = 'product';
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
		$content = (array)$content;
		$columns = array_keys($content) ?: '' ;
		if (!array_key_exists('mainImage', $content))
		{
			$content['mainImage'] = '';
		}

		$db = MySql::getInstance();

		$this->render('admin-panel-layout',[
			'title' => 'admin',
			'role' => $role,
			'content' => \ES\Controller\TemplateEngine::view('pages/admin-edit' ,
				[
					'tableName' => $tableName,
					'columns' => $columns ,
					'content' => $content,
					'len' => count($columns),
					'className' => $className,
				]
			)
		]);
	}

	function adminAddItem()
	{
		session_start();
		$role = $_SESSION['USER'] ->role;
		$token = filter_input(INPUT_POST, 'token',);

		if (!$token || $token !== $_SESSION['token']) {
			header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
			exit;
		}

		if (array_key_exists('item', $_POST))
		{
			if ($_POST['item'] === 'product')
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
					$_POST['price'],
					$_POST['main-image'] ?? '',
					$_POST['images'] ?? []
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
			}
		}
	}


	public function adminUploadImage(): string
	{
		session_start();
		if (!isset($_SESSION['USER']))
		{
			header('Location: /login/');
		}

		$input_name = 'file';

		if (!isset($_FILES[$input_name]))
		{
			exit;
		}

		// Разрешенные расширения файлов.
		$allow = array('jpg', 'jpeg', 'png', 'gif');

		// URL до временной директории.
		$url_path = '/uploads/tmp/';

		// Полный путь до временной директории.
		$tmp_path = $_SERVER['DOCUMENT_ROOT'] . $url_path;

		if (!is_dir($tmp_path))
		{
			mkdir($tmp_path, 0777, true);
		}

		// Преобразуем массив $_FILES в удобный вид для перебора в foreach.
		$files = array();
		$diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);
		if ($diff == 0)
		{
			$files = array($_FILES[$input_name]);
		}
		else
		{
			foreach($_FILES[$input_name] as $k => $l) {
				foreach($l as $i => $v) {
					$files[$i][$k] = $v;
				}
			}
		}

		$response = array();
		foreach ($files as $key => $file)
		{
			$error = $data  = '';

			// Проверим на ошибки загрузки.
			$ext = mb_strtolower(mb_substr(mb_strrchr(@$file['name'], '.'), 1));

			if (!empty($file['error']) || empty($file['tmp_name']) || $file['tmp_name'] == 'none')
			{
				$error = 'Не удалось загрузить файл.';
			}
			elseif (empty($file['name']) || !is_uploaded_file($file['tmp_name']))
			{
				$error = 'Не удалось загрузить файл.';
			}
			elseif (empty($ext) || !in_array($ext, $allow))
			{
				$error = 'Недопустимый тип файла';
			}
			else
			{
				$info = @getimagesize($file['tmp_name']);
				if (empty($info[0]) || empty($info[1]) || !in_array($info[2], array(1, 2, 3)))
				{
					$error = 'Недопустимый тип файла';
				}
				else
				{
					// Перемещаем файл в директорию с новым именем.
					$name  = time() . '-' . mt_rand(1, 9999999999);
					$src   = $tmp_path . $name . '.' . $ext;
					$thumb = $tmp_path . $name . '-thumb.' . $ext;

					if (move_uploaded_file($file['tmp_name'], $src))
					{
						// Создание миниатюры.
						switch ($info[2])
						{
							case 1:
								$im = imageCreateFromGif($src);
								imageSaveAlpha($im, true);
								break;
							case 2:
								$im = imageCreateFromJpeg($src);
								break;
							case 3:
								$im = imageCreateFromPng($src);
								imageSaveAlpha($im, true);
								break;
						}

						$width  = $info[0];
						$height = $info[1];

						// Высота превью 100px, ширина рассчитывается автоматически.
						$h = 100;
						$w = ($h > $height) ? $width : ceil($h / ($height / $width));
						$tw = ceil($h / ($height / $width));
						$th = ceil($w / ($width / $height));

						$new_im = imageCreateTrueColor($w, $h);
						if ($info[2] == 1 || $info[2] == 3)
						{
							imagealphablending($new_im, true);
							imageSaveAlpha($new_im, true);
							$transparent = imagecolorallocatealpha($new_im, 0, 0, 0, 127);
							imagefill($new_im, 0, 0, $transparent);
							imagecolortransparent($new_im, $transparent);
						}

						if ($w >= $width && $h >= $height)
						{
							$xy = array(ceil(($w - $width) / 2), ceil(($h - $height) / 2), $width, $height);
						}
						elseif ($w >= $width)
						{
							$xy = array(ceil(($w - $tw) / 2), 0, ceil($h / ($height / $width)), $h);
						}
						elseif ($h >= $height)
						{
							$xy = array(0, ceil(($h - $th) / 2), $w, ceil($w / ($width / $height)));
						}
						elseif ($tw < $w)
						{
							$xy = array(ceil(($w - $tw) / 2), ceil(($h - $h) / 2), $tw, $h);
						}
						else
						{
							$xy = array(0, ceil(($h - $th) / 2), $w, $th);
						}

						imageCopyResampled($new_im, $im, $xy[0], $xy[1], 0, 0, $xy[2], $xy[3], $width, $height);

						// Сохранение.
						switch ($info[2])
						{
							case 1: imageGif($new_im, $thumb); break;
							case 2: imageJpeg($new_im, $thumb, 100); break;
							case 3: imagePng($new_im, $thumb); break;
						}

						imagedestroy($im);
						imagedestroy($new_im);

						$checked = $key === 0 ? 'checked' : '';

						// Вывод в форму: превью, кнопка для удаления и скрытое поле.
						$data = '
							<div class="img-item">
								<input type="hidden" name="images[]" value="' . $name . '.' . $ext . '" >
								<input id="' . $name . '" type="radio" name="main-image" value="' . $name . '.' . $ext . '" ' . $checked . ' style="display:none;">
								<label for="' . $name . '" class="">
									<img class="admin-img" src="' . $url_path . $name . '-thumb.' . $ext . '">
									<a href="#" class="delete-icon" onclick="remove_img(this); return false;"></a>
								</label>
							</div>';
					}
					else
					{
						$error = 'Не удалось загрузить файл.';
					}
				}
			}

			$response[] = array('error' => $error, 'data'  => $data);
		}

		// Ответ в JSON.
		header('Content-Type: application/json');
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		exit();
	}
}
<?php

namespace ES\Controller\Admin;

use ES;
use ES\Controller\BaseController;
use ES\Model\Database\MySql;
use ES\Services\TemplateEngine;

class AdminController extends BaseController
{
	protected string $tableName = '';
	protected string $className = '';

	public function indexAction(): void
	{
		if (!isset($_SESSION['USER']))
		{
			header('Location: /login/');
		}
		$role = $_SESSION['USER']->role;
		$indexPage = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

		$deleteMessage = [];

		$content = $this->getContent();
		$columns = (!empty($content) && is_array($content)) ? array_keys((array)$content[0]) : '';
		$pageCount = $this->getPageCount();

		if (empty($content))
		{
			$content = "Тут ничего нет";
			$columns = '';
			$pageCount = 0;
		}

		if (isset($_GET['delete']))
		{
			$deleteMessage[] = "Элемент id = {$_GET['delete']} успешно удален";
		}

		$link = "/admin/{$this->className}s/?";
		$this->render('admin-panel-layout', [
			'title' => 'admin',
			'role' => $role,
			'content' => TemplateEngine::view('pages/admin-table',
				[
					'addItemLink' => $this->className,
					'tableName' => $this->tableName,
					'columns' => $columns,
					'deleteMessage' => $deleteMessage,
					'pagination' => TemplateEngine::view('components/pagination', [
						'link' => $link,
						'currentPage' => $indexPage,
						'countPage' => $pageCount,
					]),
					'content' => TemplateEngine::view('components/admin-table-rows',
						[
							'content' => $content,
						]),
				]
			),
		]);
	}

	public function editAction(int $id): void
	{
		if (!isset($_SESSION['USER']))
		{
			header('Location: /login/');
		}

		if ($id <= 0 || !is_numeric($id))
		{
			header('Location: /admin/');
		}

		$role = $_SESSION['USER']->role;

		if (!array_key_exists('token',$_SESSION))
		{
			$_SESSION['token'] = md5(uniqid(mt_rand(), true));
		}
		$content = (array)$this->getContentById($id);

		$columns = (!empty($content)) ? array_keys($content) : '';

		$this->render('admin-panel-layout', [
			'title' => 'admin',
			'role' => $role,
			'content' => TemplateEngine::view('pages/admin-edit',
				[
					'tableName' => $this->tableName,
					'columns' => $columns,
					'className' => $this->className,
					'len' => count($columns),
					'content' => $content,
					'isAdd' => false,
				]
			),
		]);
	}

	public function deleteAction(): void
	{
		if (!isset($_SESSION['USER']))
		{
			header('Location: /login/');
		}

		$token = filter_input(INPUT_POST, 'token',);

		if (!$token || $token !== $_SESSION['token'])
		{
			header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
			exit;
		}

		$table = $_POST['table'];
		$id = $_POST['id'];
		$db = MySql::getInstance();
		$db->deleteItem($table, $id);
	}

	public function changeItemAction($id): void
	{
		$token = filter_input(INPUT_POST, 'token',);
		$role = $_SESSION['USER']->role;

		if (!$token || $token !== $_SESSION['token'])
		{
			header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
			exit;
		}

		if ($id <= 0 || !is_numeric($id))
		{
			header('Location: /admin/');
		}

		if ($this->changeItem($_POST, (int)$id))
		{
			$this->render('admin-panel-layout', [
				'title' => 'admin',
				'role' => $role,
				'content' => '<h1> Данные изменены </h1>',
			]);
		}
	}

	public function addItemAction(string $type): void
	{
		$role = $_SESSION['USER']->role;

		if (!array_key_exists('token', $_SESSION))
		{
			$_SESSION['token'] = md5(uniqid(mt_rand(), true));
		}

		$type = ucfirst($type);
		$class = 'ES\Model\\' . $type;
		if (!class_exists($class))
		{
			header('Location: /admin/');
		}
		$content = get_class_vars($class);
		$columns = array_keys($content) ?: '';

		if ($type === 'User' && $role !== 'admin')
		{
			$this->render('admin-panel-layout', [
				'title' => 'admin',
				'role' => $role,
				'content' => '<h1> Недостаточно прав </h1>',
			]);
			exit;
		}

		$this->render('admin-panel-layout', [
			'title' => 'admin',
			'role' => $role,
			'content' => TemplateEngine::view('pages/admin-edit',
				[
					'tableName' => $type,
					'columns' => $columns,
					'content' => $content,
					'len' => count($columns),
					'className' => $this->className,
					'isAdd' => true,
				]
			),
		]);
	}

	public function createItemAction(): void
	{
		$role = $_SESSION['USER']->role;

		$token = filter_input(INPUT_POST, 'token',);

		if (!$token || $token !== $_SESSION['token'])
		{
			header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
			exit;
		}

		if ($this->createItem($_POST))
		{
			$this->render('admin-panel-layout', [
				'title' => 'admin',
				'role' => $role,
				'content' => '<h1> Данные добавлены </h1>',
			]);
		}
	}

	protected function getContent(): mixed
	{
		return 'Выберите пункт меню';
	}

	protected function getContentById(int $id): mixed
	{
		return 'Выберите пункт меню';
	}

	protected function getPageCount(): int
	{
		return 0;
	}

	protected function changeItem(array $data, int $id): bool
	{
		return false;
	}

	protected function createItem(array $data): bool
	{
		return false;
	}
}
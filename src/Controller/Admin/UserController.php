<?php

namespace ES\Controller\Admin;

use ES\Model\Database\MySql;
use ES\Model\User;

class UserController extends AdminController
{
	protected string $tableName = 'Пользователи';
	protected string $className = 'user';

	protected function getContent(): ?array
	{
		return MySql::getInstance()->getUsers();
	}

	protected function getContentById(int $id): ?object
	{
		if ($_SESSION['USER']->role !== 'admin')
		{
			$this->render('admin-panel-layout', [
				'title' => 'admin',
				'role' => $_SESSION['USER']->role,
				'content' => '<h1> Недостаточно прав </h1>',
			]);
			exit;
		}
		return MySql::getInstance()->getUserById($id);
	}

	protected function getPageCount(): int
	{
		return MySql::getInstance()->getPageCount('','user');
	}

	protected function changeItem($data,$id): bool
	{
		$password = $data['password'] ?: MySql::getInstance()->getUserById($id)->password;
		$item = new User(
			$_POST['id'],
			$password,
			$_POST['login'],
			$_POST['mail'],
			$_POST['role'],
			$_POST['firstName'],
			$_POST['lastName']
		);
		return MySql::getInstance()->updateUser($item);
	}

	protected function createItem(array $data): bool
	{
		$password = $_POST['password'] ?: MySql::getInstance()->getUserById($_GET['user'])->password;
		$changedUser = new User(
			1,
			$password,
			$data['login'],
			$data['mail'],
			$data['role'],
			$data['firstName'],
			$data['lastName']
		);
		return MySql::getInstance()->createUser($changedUser);
	}
}
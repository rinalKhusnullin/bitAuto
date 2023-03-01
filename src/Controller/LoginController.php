<?php

namespace ES\Controller;

use ES\Model\Database\MySql;
use ES\Model\User;
use ES\Services\ConfigurationService;
use ES\Services\TemplateEngine;

class LoginController extends BaseController
{
	public function getLoginAction(): void
	{
		session_start();
		if (isset($_SESSION['USER']))
		{
			header('Location: /admin/?products');
		}

		$db = MySql::getInstance();
		$brands = $db->getTagByName('brand');
		$carcases = $db->getTagByName('carcase');
		$transmissions = $db->getTagByName('transmission');

		$errors = [];

		if (isset($_POST['login']))
		{
			$login = $_POST['login'];
			$password = $_POST['password'];
			$error = 'Неверный логин или пароль';

		//	Индетификация
			$user = User::getUserByLogin($login);

			if (!$user)
			{
				$errors[] = $error;
			}
			else
			{
			//	аутентификация
				$isPasswordCorrect = password_verify($password, $user->password);

				if (!$isPasswordCorrect)
				{
					$errors[] = $error;
				}
				else
				{
					session_start();

					$_SESSION['USER'] = $user;
					header('Location: /admin/ ');
					exit();
				}
			}
		}
		$role = array_key_exists('USER' , $_SESSION)? $_SESSION['USER']->role : 'user';

		$this->render('layout', [
			'title' => ConfigurationService::getConfig('TITLE_LOG_IN', 'AutoBit Log In'),
			'role' => $role,
			'tags' => TemplateEngine::view('components/tags', [
				'brands' => $brands,
				'carcases' => $carcases,
				'transmissions' => $transmissions,
			]),
			'content' => TemplateEngine::view('pages/login', [
					'errors' => $errors,
				]),
		]);
	}
}
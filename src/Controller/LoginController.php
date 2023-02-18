<?php

namespace ES\Controller;

use ES\config\ConfigurationController;
use ES\Model\Database\MySql;
use ES\Model\User;


class LoginController extends BaseController
{
	public function getLoginAction(): void
	{
		session_start();
		if (isset($_SESSION['USER']))
		{
			header('Location: /admin/?products');
		}

		$tags = MySql::getInstance()->getTagList();

		$errors = [];

		if (isset($_POST['login']))
		{
			$login = $_POST['login'];
			$password = $_POST['password'];
			$hash = password_hash('111', PASSWORD_DEFAULT);

			$error = 'Не верный лониг или пароль';

		//	Индетификация
			$user = User::getUserByLogin($login);

			if (!$user)
			{
				$errors[] = $error;
			}
			else
			{
			//	аутентификация
				$isPasswordCorrect = password_verify($password, $hash);

				if (!$isPasswordCorrect)
				{
					$errors[] = $error;
				}
				else
				{
					session_start();

					$_SESSION['USER'] = $user;
					header('Location: /admin/?products ');
					exit();
				}
			}
		}
		$role = array_key_exists('USER' , $_SESSION)? $_SESSION['USER']->role : 'user';

		$this->render('layout', [
			'title' => ConfigurationController::getConfig('TITLE_LOG_IN', 'AutoBit Log In'),
			'role' => $role,
			'tags' => $tags,
			'content' => TemplateEngine::view('pages/login', [
					'errors' => $errors,
				]),
		]);
	}
}

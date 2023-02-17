<?php

namespace ES\Model;

use ES\Model\Database\MySql;

class User
{
	public function __construct(
		public int $id,
		public string $password,
		public string $login,
		public string $mail,
		public string $role,
		public string $firstName,
		public string $lastName,
	)
	{}

	public static function getUserByLogin(string $login): ?object
	{
		$userList = MySql::getInstance()->getUsers();

		$userIndex = array_search($login, array_column($userList, 'login'), true);
		if ($userIndex === false)
		{
			return null;
		}

		$user = $userList[$userIndex];

		return $user;
	}
}
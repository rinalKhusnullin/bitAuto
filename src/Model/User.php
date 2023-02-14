<?php

namespace ES\Model;

class User
{
	public static function getUserByLogin(string $login): ?array
	{
		function getUserList(): array
		{
			return [
				[
					'id' => 1,
					'login' => 'tania',
					'password' => '111',
					'role' => 'admin',
				]
			];
		}

		$userList = getUserList();

		$userIndex = array_search($login, array_column($userList, 'login'), true);
		if ($userIndex === false)
		{
			return null;
		}

		return $userList[$userIndex];
	}
}
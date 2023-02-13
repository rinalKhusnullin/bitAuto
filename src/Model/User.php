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
					'login' => 'admin',
					'password' => '111',
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
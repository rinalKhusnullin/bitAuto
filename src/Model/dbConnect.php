<?php

namespace ES\model;

use ES\controller\option;

abstract class dbConnect
{
	private function getDBConnect(): ?mysqli
	{
		static $connection = null;

		if ($connection === null)
		{
			$dbHost = option::getConfig('DB_HOST');
			$dbUser = option::getConfig('DB_USER');
			$dbPassword = option::getConfig('DB_PASSWORD');
			$dbName = option::getConfig('DB_NAME');

			$connection = mysqli_init();

			$connected = mysqli_real_connect($connection, $dbHost, $dbUser, $dbPassword, $dbName);

			if (!$connected)
			{
				$error = mysqli_connect_errno() . ': ' . mysqli_connect_error();
				throw new Exception($error);
			}

			$encodingResult = mysqli_set_charset($connection, 'utf8');

			if (!$encodingResult)
			{
				throw new Exception(mysqli_error($connection));
			}
		}
		return $connection;
	}
}
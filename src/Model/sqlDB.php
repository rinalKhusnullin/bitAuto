<?php

namespace es\model;

use ES\controller\Option;
use ES\Model\DB;

class sqlDB extends DB
{

	function connect(): ?mysqli
	{
		static $connection = null;

		if ($connection === null)
		{
			$dbHost = Option::getConfig('DB_HOST');
			$dbUser = Option::getConfig('DB_USER');
			$dbPassword = Option::getConfig('DB_PASSWORD');
			$dbName = Option::getConfig('DB_NAME');

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

	function getData(): array
	{
		$connection = $this->connect();
		$query = '';
		$result = mysqli_query($connection, $query);
		return $result;
	}

	function getDataByID(): array
	{
		// TODO: Implement getDataByID() method.
	}

	function getDataByTeg(): array
	{
		// TODO: Implement getDataByTeg() method.
	}

	function updateData()
	{
		// TODO: Implement updateData() method.
	}

	function createData()
	{
		// TODO: Implement createData() method.
	}

	function deleteData()
	{
		// TODO: Implement deleteData() method.
	}
}
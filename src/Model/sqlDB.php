<?php

namespace ES\Model;

use ES\Controller\Option;
use ES\Model\DB;

class sqlDB extends DB
{

	function connect()
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

	function getData($page = 0): array
	{
		if ($page > 1) $page = $page * 10 - 10;
		$countProductsOnPage = option::getConfig('CountProductsOnPage');
		$connection = $this->connect();
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.SHORT_DESCRIPTION, p.FULL_DESCRIPTION, p.PRODUCT_PRIСE
					FROM products p
					inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
					limit $countProductsOnPage offset $page";
		$result = mysqli_query($connection, $query);
		return $this->buildProduct($result,$connection);
	}

	function getDataByID($id): array
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
	function buildProduct($result,$connection): array
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			$product[] = new Products\Product(
				$row['id'],
				$row['name'],
				$row['IS_ACTIVE'],
				$row['brand'],
				$row['transmission'],
				$row['carcase'],
				$row['DATE_CREATION'],
				$row['DATE_UPDATE'],
				$row['SHORT_DESCRIPTION'],
				$row['FULL_DESCRIPTION'],
				$row['PRODUCT_PRIСE']
			);
		}
		return $product;
	}
}
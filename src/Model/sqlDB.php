<?php

namespace ES\Model;

use ES\Controller\ConfigurationController;
// use ES\Model\DB;
use ES\Model\Products\Product;

class sqlDB extends DB
{
	private $conection= DbConnection::getInstance();

	function connect()
	{
		static $connection = null;

		if ($connection === null)
		{
			$dbHost = ConfigurationController::getConfig('DB_HOST');
			$dbUser = ConfigurationController::getConfig('DB_USER');
			$dbPassword = ConfigurationController::getConfig('DB_PASSWORD');
			$dbName = ConfigurationController::getConfig('DB_NAME');

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
		$countProductsOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		if ($page > 1) $page = $page * $countProductsOnPage - $countProductsOnPage;
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


	function getDataByID($id) : Product
	{
		$connection = $this->connect();
		$id = mysqli_real_escape_string($connection, $id);
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.SHORT_DESCRIPTION, p.FULL_DESCRIPTION, p.PRODUCT_PRIСE
					FROM products p
					inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
					where $id = p.id";
		$result = mysqli_query($connection, $query);
		return $this->buildProduct($result, $connection)[0];
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
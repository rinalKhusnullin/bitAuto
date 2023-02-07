<?php

namespace ES\Model;

use ES\Controller\ConfigurationController;
use ES\Model\Products\Product;

class sqlDB extends DB
{
	function getData($isPublic, $page = 0): array
	{
		$countProductsOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		if ($page > 1)
		{
			$page = $page * $countProductsOnPage - $countProductsOnPage;
		}
		else
		{
			$page = 0;
		}
		$connection = DbConnection::getInstance()->getConnection();
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.SHORT_DESCRIPTION, p.FULL_DESCRIPTION, p.PRODUCT_PRIСE
					FROM products p
					inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id";
		if ($isPublic)
		{
			$query .= "\n" ."where p.IS_ACTIVE = true
						limit $countProductsOnPage offset $page";

		}
		else
		{
			$query .= "\n" . "limit $countProductsOnPage offset $page";
		}
		$result = mysqli_query($connection, $query);
		return $this->buildProduct($result,$connection);
	}


	function getDataByID($id) : ?Product
	{
		$connection = DbConnection::getInstance()->getConnection();
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

	function getDataByTeg($brand, $carcase, $transmission, $page = 0 ): ?array
	{
		$countProductsOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		if ($page > 1)
		{
			$page = $page * $countProductsOnPage - $countProductsOnPage;
		}
		else
		{
			$page = 0;
		}
		$connection = DbConnection::getInstance()->getConnection();
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.SHORT_DESCRIPTION, p.FULL_DESCRIPTION, p.PRODUCT_PRIСE
					FROM products p
	 				inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
					where ";
		$tegs = [];
		if (isset($brand))
		{
			$tegs[] = "b.brand = '$brand'";
		}
		if (isset($carcase))
		{
			$tegs[] = "c.carcase = '$carcase'";
		}
		if (isset($transmissoin))
		{
			$tegs[] = "t.transmission = '$transmission'";
		}
		if (empty($tegs))
		{
			return $this->getData(true);
		}
		$query .= implode(' and ', $tegs);
		$result = mysqli_query($connection, $query);
		return $this->buildProduct($result,$connection);
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
	function buildProduct($result,$connection): ?array
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

	function getPageCount()
	{
		$connection = DbConnection::getInstance()->getConnection();
		$countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$query = 'SELECT Count(id)
					from products;';
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_row($result);
		return ceil($row[0] / $countProductOnPage);

	}

	function createOrder(Order $order) :bool
	{
		$connection =DbConnection::getInstance()->getConnection();

		$productId = $order->product->id;
		$productPrice = $order->product->price;
		$status = mysqli_real_escape_string($connection, $order->status);
		$dateCreation = $order->dateCreation;
		$fullName = mysqli_real_escape_string($connection, $order->fullName);
		$phone = mysqli_real_escape_string($connection, $order->phone);
		$mail = mysqli_real_escape_string($connection, $order->mail);
		$comment = mysqli_real_escape_string($connection, $order->comment);

		$query = "INSERT INTO orders (product_id, product_price, status, date_creation, customer_name, customer_phone, customer_mail, comment)
					values ( $productId, $productPrice, '$status', CURRENT_DATE(), '$fullName', '$phone', '$mail', '$comment' )";

		return mysqli_query($connection,$query);

	}
}
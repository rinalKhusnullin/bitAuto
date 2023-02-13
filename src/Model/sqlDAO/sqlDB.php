<?php

namespace ES\Model\sqlDAO;

use ES\Model\DB;
use ES\Model\Order;
use ES\Model\Product;
use ES\config\ConfigurationController;

class sqlDB extends DB
{
	private $connection;
	public function __construct()
	{
		$this->connection = DbConnection::getInstance()->getConnection();
	}

	function getProductData($isPublic, $page = 0): array
	{
		$countProductsOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$page = ($page > 1) ? $page * $countProductsOnPage - $countProductsOnPage : 0;
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.SHORT_DESCRIPTION, p.FULL_DESCRIPTION, p.PRODUCT_PRICE
					FROM products p
					inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id";
		if ($isPublic)
		{
			$query .= "\n" ."where p.IS_ACTIVE = true" . "\n" .
				"group by p.ID" . "\n" ."limit $countProductsOnPage offset $page";
		}
		else
		{
			$query .= "\n" . "group by p.ID". "\n" ."limit $countProductsOnPage offset $page";
		}
		$result = mysqli_query($this->connection, $query);
		return $this->buildProduct($result);
	}


	function getProductDataByID($id) : ?Product
	{
		$id = mysqli_real_escape_string($this->connection, $id);
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.SHORT_DESCRIPTION, p.FULL_DESCRIPTION, p.PRODUCT_PRICE
					FROM products p
					inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
					where $id = p.id";
		$result = mysqli_query($this->connection, $query);
		return $this->buildProduct($result)[0];
	}

	function getDataBySQuery(string $sQuery, int $page = 0) : array
	{
		$countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$page = ($page > 1) ? $page * $countProductOnPage - $countProductOnPage : 0;
		$sQuery = strtolower($sQuery);
		$pageCount = $this->getPageCount(true,$sQuery);
		$sQuery = mysqli_real_escape_string($this->connection, $sQuery);

		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.SHORT_DESCRIPTION, p.FULL_DESCRIPTION, p.PRODUCT_PRICE
			FROM products p
			inner join brand b on p.ID_BRAND = b.id
			inner join carcase c on p.ID_CARCASE = c.id
			inner join transmission t on p.ID_TRANSMISSION = t.id
			where LOWER(p.name) LIKE '%$sQuery%' or LOWER(p.SHORT_DESCRIPTION) LIKE '%$sQuery%'
			 limit $countProductOnPage offset $page";

		$result = mysqli_query($this->connection, $query);

		return [$this->buildProduct($result), $pageCount];

	}

	function getProductDataByTeg($brand, $carcase, $transmission, $page = 0 ): ?array
	{
		$countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$page = ($page > 1) ? $page * $countProductOnPage - $countProductOnPage : 0;
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.SHORT_DESCRIPTION, p.FULL_DESCRIPTION, p.PRODUCT_PRICE
					FROM products p
	 				inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
					where ";

		$tegs = [];
		if (isset($brand)) $tegs[] = "b.brand = '$brand'";
		if (isset($carcase)) $tegs[] = "c.carcase = '$carcase'";
		if (isset($transmission)) $tegs[] = "t.transmission = '$transmission'";

		if (empty($tegs)) return $this->getProductData(true);

		$query .= implode(' and ', $tegs);
		$result = mysqli_query($this->connection, $query);

		//Узнать сколько будет страниц с учетом пагинации
		$pageCount = ceil(mysqli_num_rows($result) / $countProductOnPage);

		//Залимитить под пагинацию
		$query .= " limit $countProductOnPage offset $page";

		//вернуть массив из продуктов и сколько всего записей
		$result = mysqli_query($this->connection, $query);
		return [$this->buildProduct($result), $pageCount];
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
	function buildProduct($result): ?array
	{
		$product = [];
		while ($row = mysqli_fetch_assoc($result))
		{
			$product[] = new \ES\Model\Product(
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
				$row['PRODUCT_PRICE']
			);
		}
		return $product;
	}

	function getPageCount($isQuery = false, $argument = null)
	{
		$countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$query = 'SELECT id, name, SHORT_DESCRIPTION
					from products';
		if ($isQuery)
		{
			$query .= "\n" . "where LOWER(name) LIKE '%$argument%' or LOWER(SHORT_DESCRIPTION) LIKE '%$argument%'";
		}
		$result = mysqli_query($this->connection, $query);
		return ceil(mysqli_num_rows($result) / $countProductOnPage);

	}

	function createOrder(Order $order) :bool
	{
		$productId = $order->product->id;
		$productPrice = $order->product->price;
		$status = mysqli_real_escape_string($this->connection, $order->status);
		$dateCreation = $order->dateCreation;
		$fullName = mysqli_real_escape_string($this->connection, $order->fullName);
		$phone = mysqli_real_escape_string($this->connection, $order->phone);
		$mail = mysqli_real_escape_string($this->connection, $order->mail);
		$comment = mysqli_real_escape_string($this->connection, $order->comment);

		$query = "INSERT INTO orders (product_id, product_price, status, date_creation, customer_name, customer_phone, customer_mail, comment)
					values ( $productId, $productPrice, '$status', CURRENT_DATE(), '$fullName', '$phone', '$mail', '$comment' )";

		return mysqli_query($this->connection,$query);

	}

	function getTegs(): ?array
	{
		$queryBrand = 'Select BRAND
					   from brand';
		$resultBrand = mysqli_query($this->connection,$queryBrand);
		$brand = [];
			while ($row = mysqli_fetch_assoc($resultBrand))
			{
				$brand[] = $row;
			}

		$queryCarcase = 'Select CARCASE
						 from carcase';
		$resultCarcase = mysqli_query($this->connection,$queryCarcase);
		$carcase = [];
		while ($row = mysqli_fetch_assoc($resultCarcase))
		{
			$carcase[] = $row;
		}

		$queryTransmission = 'Select TRANSMISSION
							  from transmission';
		$resultTransmissoin = mysqli_query($this->connection,$queryTransmission);
		$transmission = [];
		while ($row = mysqli_fetch_assoc($resultTransmissoin))
		{
			$transmission[] = $row;
		}


		$tegs[0] = $brand;
		$tegs[1] = $carcase;
		$tegs[2] = $transmission;
		return $tegs;
	}
}
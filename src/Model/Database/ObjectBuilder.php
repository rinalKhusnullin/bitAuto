<?php

namespace ES\Model\Database;

use ES\Model\Product;
use ES\Model\Order;
use ES\Model\User;
use ES\Model\Tags;

class ObjectBuilder
{
    static function buildProducts($result)
    {
        $products = [];
		while ($row = mysqli_fetch_assoc($result))
		{
            $isActive = (isset($row['IS_ACTIVE'])) ? true : false;
			$products[] = new Product(
				$row['id'],
				$row['name'],
				$isActive,
				$row['brand'],
				$row['transmission'],
				$row['carcase'],
				$row['DATE_CREATION'],
				$row['DATE_UPDATE'],
				$row['FULL_DESCRIPTION'],
				(int)$row['PRODUCT_PRICE']
			);
		}
		return $products;
    }

	static function buildOrders($result)
	{
		$orders = [];
		while ($row = mysqli_fetch_assoc($result))
		{
			[$lastname, $name] = explode(' ', $row["CUSTOMER_NAME"]);
			$orders[] = new Order(
				$lastname,
				$name,
				$row['CUSTOMER_PHONE'],
				$row['CUSTOMER_MAIL'],
				$row['CUSTOMER_ADDRESS'],
				$row['COMMENT'],
				$row['PRODUCT_ID'],
				$row['PRODUCT_PRICE'],
				$row['DATE_CREATION'],
				$row['STATUS']
			);
		}
		return $orders;
	}

	static function buildUsers($result)
	{
		$users = [];
		while ($row = mysqli_fetch_assoc($result))
		{
			$users[] = new User(
				$row['ID'],
				$row['PASS'],
				$row['LOGIN'],
				$row['MAIL'],
				$row['ROLE'],
				$row['FIRST_NAME'],
				$row['LAST_NAME']
			);
		}
		return $users;
	}

	static function buildBrands($result)
	{
		$brands = [];
		while ($row = mysqli_fetch_assoc($result)){
			$brands[] = new Tags\Brand(
				$row['ID'],
				$row['BRAND']
			);
		}
		return $brands;
	}

	static function buildCarcases($result)
	{
		$carcases = [];
		while ($row = mysqli_fetch_assoc($result)){
			$carcases[] = new Tags\Carcase(
				$row['ID'],
				$row['CARCASE']
			);
		}
		return $carcases;
	}

	static function buildTransmissions($result)
	{
		$transmissions = [];
		while ($row = mysqli_fetch_assoc($result)){
			$transmissions[] = new Tags\Brand(
				$row['ID'],
				$row['TRANSMISSION']
			);
		}
		return $transmissions;
	}
}
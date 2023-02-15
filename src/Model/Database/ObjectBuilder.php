<?php 

namespace ES\Model\Database;

use ES\Model\Product;
use ES\Model\Order;

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
				$row['PRODUCT_PRICE']
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
				(MySql::getInstance())->getProductByID($row['PRODUCT_ID']), // Это очевидный костыль, я скорее всего буду делать функции MySql статическими
				$row['DATE_CREATION'],
				$row['STATUS']
			);
		}
		return $orders;
	}
}
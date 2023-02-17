<?php

namespace ES\Model\Database;

use ES\Model\Product;
use ES\Model\Order;
use ES\Model\User;


class ObjectBuilder
{
    public static function buildProducts(array $goods): array
	{
        $products = [];
		foreach ($goods as $good)
		{
			$products[] = new Product(...$good);
		}
		return $products;
    }

	public static function buildOrders(array $results): array
	{
		$orders = [];
		foreach ($results as $result)
		{
			$orders[] = new Order(...$result);
		}
		return $orders;
	}

	public static function buildUsers($result)
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

	public static function buildTags($result, string $tag)
	{
		$className= 'ES\\Model\\Tags\\' . $tag;
		$tags = [];
		while ($row = mysqli_fetch_assoc($result)){
			$tags[] = new $className(
				$row['ID'],
				$row[$tag]
			);
		}
		return $tags;
	}
}
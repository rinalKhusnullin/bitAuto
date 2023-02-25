<?php

namespace ES\Model\Database;

use ES\HtmlService;
use ES\Model\Product;
use ES\Model\Order;
use ES\Model\User;
use ES\Model\Database\RequestSql;

class ObjectBuilder
{
	public static function buildProducts( $result): array
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			$products[] = new Product(
				$row['id'],
				$row['name'],
				$row['IS_ACTIVE'],
				$row['brand'],
				$row['transmission'],
				$row['carcase'],
				$row['DATE_CREATION'],
				$row['DATE_UPDATE'],
				$row['FULL_DESCRIPTION'],
				$row['PRODUCT_PRICE'],
				'',
				[],
			);
		}

		$db=MySql::getInstance();

		$id = '';

		foreach ($products as $product)
		{
			$id .= $product->id . ', ';
		}
		$id = substr($id, 0, -2);

		$images = $db->getImagesById($id);

		foreach ($products as $product)
		{
			foreach ($images as $image)
			{
				if ((int)$image['id'] === $product->id)
				{
					$product->images[] = $image['path'];
					if($image['isMain'] === '1')
					{
						$product->mainImage = $image['path'];
					}
				}
			}
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
		$className = 'ES\\Model\\Tags\\' . $tag;
		$tags = [];
		while ($row = mysqli_fetch_assoc($result))
		{
			$tags[] = new $className(
				$row['ID'],
				$row[$tag]
			);
		}
		return $tags;
	}
}
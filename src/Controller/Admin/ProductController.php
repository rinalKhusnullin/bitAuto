<?php

namespace ES\Controller\Admin;

use ES\Model\Database\MySql;
use ES\Model\Product;

class ProductController extends AdminController
{
	protected string $tableName = 'Продукция';
	protected string $className = 'product';

	protected function getContent(): ?array
	{
		$indexPage = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
		return MySql::getInstance()->getProducts($indexPage, 'all');
	}

	protected function getContentById(int $id): ?object
	{
		return MySql::getInstance()->getProductByID($id);
	}

	protected function getPageCount(): int
	{
		return MySql::getInstance()->getPageCount('all');
	}

	protected function changeItem(array $data, $id): bool
	{
		$item = new Product(
			$data['id'],
			$data['title'],
			$data['isActive'],
			$data['brandType'],
			$data['transmissionType'],
			$data['carcaseType'],
			$data['dateCreation'],
			date('Y-m-d H:i:s'),
			$data['fullDesc'],
			$data['price'],
			$data['main-image'] ?? '',
			$data['images'] ?? []
		);
		return MySql::getInstance()->updateProduct($item);
	}

	protected function createItem(array $data): bool
	{
		$item = new Product(
			1,
			$data['title'],
			$data['isActive'],
			$data['brandType'],
			$data['transmissionType'],
			$data['carcaseType'],
			$data['dateCreation'],
			date('Y-m-d H:i:s'),
			$data['fullDesc'],
			$data['price'],
			$data['main-image'] ?? '',
			$data['images'] ?? []
		);

		return MySql::getInstance()->createProduct($item);
	}
}
<?php

namespace ES\Controller\Admin;

use ES\Model\Database\MySql;
use ES\Model\Order;

class OrderController extends AdminController
{
	protected string $tableName = 'Заказы';
	protected string $className = 'order';

	protected function getContent(): ?array
	{
		return MySql::getInstance()->getOrders();
	}

	protected function getContentById(int $id): ?object
	{
		return MySql::getInstance()->getOrderById($id);
	}

	protected function getPageCount(): int
	{
		return MySql::getInstance()->getPageCount('', "`order`");
	}

	protected function changeItem($data, $id): bool
	{
		$item = new Order(
			$data['id'],
			$data['fullName'],
			$data['phone'],
			$data['mail'],
			$data['address'],
			$data['comment'],
			$data['productId'],
			$data['productPrice'],
			$data['dateCreation'],
			$data['status']
		);

		return MySql::getInstance()->updateOrder($item);
	}

	protected function createItem(array $data): bool
	{
		$changedOrder = new Order(
			1,
			$data['fullName'],
			$data['phone'],
			$data['mail'],
			$data['address'],
			$data['comment'],
			$data['productId'],
			$data['productPrice'],
			$data['dateCreation'],
			$data['status']
		);

		return MySql::getInstance()->createOrder($changedOrder);
	}
}
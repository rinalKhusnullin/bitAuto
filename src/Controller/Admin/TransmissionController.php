<?php

namespace ES\Controller\Admin;

use ES\Model\Database\MySql;

class TransmissionController extends AdminController
{
	protected string $tableName = 'Коробка передач';
	protected string $className = 'transmission';

	protected function getContent(): ?array
	{
		return MySql::getInstance()->getTagByName('Transmission');
	}

	protected function getContentById(int $id): ?object
	{
		return MySql::getInstance()->getTagById($id, 'Transmission');
	}

	protected function getPageCount(): int
	{
		return MySql::getInstance()->getPageCount('','transmission');
	}

	protected function changeItem($data,$id): bool
	{
		$value = $data['value'];
		$tag = $data['item'];

		return MySql::getInstance()->updateTags($tag,(int)$data['id'],$value);
	}

	protected function createItem(array $data): bool
	{
		return MySql::getInstance()->createTags('Transmission', $data['value']);
	}
}
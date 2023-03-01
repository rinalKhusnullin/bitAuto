<?php

namespace ES\Controller\Admin;

use ES\Model\Database\MySql;

class CarcaseController extends AdminController
{
	protected string $tableName = 'Кузов';
	protected string $className = 'carcase';

	protected function getContent(): ?array
	{
		return MySql::getInstance()->getTagByName('Carcase');
	}

	protected function getContentById(int $id): ?object
	{
		return MySql::getInstance()->getTagById($id, 'Carcase');
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
		return MySql::getInstance()->createTags('Carcase', $data['value']);
	}
}
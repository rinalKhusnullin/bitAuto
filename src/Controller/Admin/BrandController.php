<?php

namespace ES\Controller\Admin;

use ES\Model\Database\MySql;

class BrandController extends AdminController
{
	protected string $tableName = 'Бренды';
	protected string $className = 'brand';

	protected function getContent(): ?array
	{
		return MySql::getInstance()->getTagByName('Brand');
	}

	protected function getContentById(int $id): ?object
	{
		return MySql::getInstance()->getTagById($id, 'Brand');
	}

	protected function getPageCount(): int
	{
		return MySql::getInstance()->getPageCount('', 'brand');
	}

	protected function changeItem($data, $id): bool
	{
		$value = $data['value'];
		$tag = $data['item'];

		return MySql::getInstance()->updateTags($tag, (int)$data['id'], $value);
	}

	protected function createItem(array $data): bool
	{
		return MySql::getInstance()->createTags('Brand', $data['value']);
	}
}
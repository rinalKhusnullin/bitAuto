<?php

namespace ES\Model\Products;

class Product
{
	public function __construct(
		public int $id,
		public string $title,
		public bool $isActive,
		public string $brand,
		public string $transmission,
		public string $carcaseType,
		public string $dateCreation,
		public ?string $dateUpdate,
		public string $shortDesc,
		public string $fullDesc,
		public int $price
	)
	{}
}
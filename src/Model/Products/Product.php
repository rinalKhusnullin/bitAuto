<?php

namespace ES\Model\Products;

class Product
{
	public function __construct(
		public int $id,
		public string $title,
		public bool $is_active,
		public string $brand,
		public string $transmission,
		public string $carcaseType,
		public string $dateCreation,
		public string $dateUpdate,
		public string $shortDesc,
		public string $fullDesc,
		public int $price
	)
	{
	}

	public function getData(): array
	{
		return [
			'id' => $this->id,
			'Name' => $this->title,
			'IS_ACTIVE' => $this->is_active,
			'Brand' => $this->brand,
			'Transmission' => $this->transmission,
			'Carcase' => $this->carcaseType,
			'DateCreation' => $this->dateCreation,
			'DateUpdate' => $this->dateUpdate,
			'ShortDesc' => $this->shortDesc,
			'FullDesc' => $this->price
		];
	}
}
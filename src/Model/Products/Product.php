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
	{
	}

	public function getProductCarcase(): array
	{
		return [
			'id' => $this->id,
			'title' => $this->title,
			'isActive' => $this->isActive,
			'brand' => $this->brand,
			'transmission' => $this->transmission,
			'carcaseType' => $this->carcaseType,
			'dateCreation' => $this->dateCreation,
			'dateUpdate' => $this->dateUpdate,
			'shortDesc' => $this->shortDesc,
			'fullDesc' => $this->fullDesc,
			'price' => $this->price,
		];
	}
}
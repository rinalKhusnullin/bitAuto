<?php

namespace ES\Model\Products;

class Product
{
	public function __construct(
		public int $id,
		public string $brand,
		public string $title,
		public string $carcaseType,
		public string $transmission,
		public int $price
	)
	{
	}

	public function getData(): array
	{
		return [
			'id' => $this->id,
			'brand' => $this->brand,
			'title' => $this->title,
			'carcaseType' => $this->carcaseType,
			'transmission' => $this->transmission,
			'price' => $this->price,
		];
	}
}
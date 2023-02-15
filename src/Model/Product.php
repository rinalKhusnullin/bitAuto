<?php

namespace ES\Model;

class Product
{
	public function __construct(
		public int $id,
		public string $title,
		public bool $isActive,
		public string $brandType,
		public string $transmissionType,
		public string $carcaseType,
		public string $dateCreation,
		public ?string $dateUpdate,
		public string $fullDesc,
		public int $price
	)
	{}

	public function equals(Product $product): bool
	{
		return $this->id === $product->id && $this->title === $product->title && $this->isActive === $product->isActive
			&& $this->brand === $product->brand && $this->transmission === $product->transmission && $this->carcaseType === $product->carcaseType
			&& $this->dateCreation === $product->dateCreation && $this->dateUpdate === $product->dateUpdate
			&& $this->fullDesc === $product->fullDesc && $this->price === $product->price;
	}

	public function __toString()
	{
		return (string)$this->id;
	}
}
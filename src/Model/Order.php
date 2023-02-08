<?php

namespace ES\Model;

class Order
{
	public string $fullName;

	public function __construct(
		public string $lastname,
		public string $name,
		public string $phone,
		public string $mail,
		public string $address,
		public ?string $comment,
		public Products\Product $product,
		public ?string $dateCreation,
		public string $status = 'processing',
	)
	{
		$this->fullName = $this->lastname . ' ' . $this->name;
	}
}
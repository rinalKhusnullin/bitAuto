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
		public \ES\Model\Product $product,
		public ?string $dateCreation,
		public string $status = 'processing',
	)
	{
		$this->fullName = $this->lastname . ' ' . $this->name;
	}

	public function equals(Order $o): bool
	{
		$isEqualProducts = $this->product->equals($o->product);
		return $this->fullName === $o->fullName && $this->phone === $o->phone && $this->mail === $o->mail
			&& $this->address === $o->address && $this->comment === $o->comment && $isEqualProducts
			&& $this->dateCreation === $o->dateCreation && $this->status === $o->status;
	}
}
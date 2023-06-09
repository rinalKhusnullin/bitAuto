<?php

namespace ES\Model;

class Order
{
	public function __construct(
		public string $id,
		public string $fullName,
		public string $phone,
		public string $mail,
		public string $address,
		public ?string $comment,
		public string $productId,
		public string $productPrice,
		public ?string $dateCreation,
		public string $status = 'processing',
	)
	{
	}

	public function equals(Order $o): bool
	{
		return $this->fullName === $o->fullName && $this->phone === $o->phone && $this->mail === $o->mail
			&& $this->address === $o->address && $this->comment === $o->comment && $this->productId === $o->productId
			&& $this->productPrice === $o->productPrice && $this->dateCreation === $o->dateCreation && $this->status === $o->status;
	}
}
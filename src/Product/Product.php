<?php 

namespace ES\Product;

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
    {}
}
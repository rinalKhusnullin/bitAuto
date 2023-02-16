<?php 

namespace ES\Model\Tags;

class Brand
{
    public function __construct(
        public int $id,
        public string $value
    )
    {}
}
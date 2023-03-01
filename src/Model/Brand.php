<?php

namespace ES\Model;

class Brand
{
    public function __construct(
        public int $id,
        public string $value
    )
    {}
}
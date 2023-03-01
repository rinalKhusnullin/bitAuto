<?php

namespace ES\Model;

class Carcase
{
    public function __construct(
        public int $id,
        public string $value
    )
    {}
}
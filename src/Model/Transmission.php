<?php

namespace ES\Model;

class Transmission
{
    public function __construct(
        public int $id,
        public string $value
    )
    {}
}
<?php 

namespace ES\Model\Tags;

class Carcase
{
    public function __construct(
        public int $id,
        public string $value
    )
    {}
}
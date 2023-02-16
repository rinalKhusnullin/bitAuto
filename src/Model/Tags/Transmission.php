<?php 

namespace ES\Model\Tags;

class Transmission
{
    public function __construct(
        public int $id,
        public string $value
    )
    {}
}
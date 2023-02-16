<?php 

namespace ES\Model\Tags;

use ES\Model\Tag;

class Brand extends Tag
{
    public function __construct(
        public int $id,
        public string $value
    )
    {}
}
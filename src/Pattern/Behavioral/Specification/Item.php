<?php

namespace Tools\Pattern\Behavioral\Specification;

class Item
{
    private $price;
    
    public function __construct(float $price)
    {
        $this->price = $price;
    }
    
    public function getPrice(): float
    {
        return $this->price;
    }
}

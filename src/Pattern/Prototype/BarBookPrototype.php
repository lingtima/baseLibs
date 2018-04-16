<?php

namespace Tools\Pattern\Prototype;

class BarBookPrototype extends BookPrototype
{
    protected $category = 'bar';
    
    /** @noinspection MagicMethodsValidityInspection */
    public function __clone()
    {
    }
}
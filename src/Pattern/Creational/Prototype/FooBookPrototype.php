<?php

namespace Tools\Pattern\Creational\Prototype;

class FooBookPrototype extends BookPrototype
{
    protected $category = 'Foo';
    
    /** @noinspection MagicMethodsValidityInspection */
    public function __clone()
    {

    }
}
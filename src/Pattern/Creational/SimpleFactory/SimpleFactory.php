<?php

namespace Tools\Pattern\Creational\SimpleFactory;

class SimpleFactory
{
    public function createBicycle()
    {
        return new Bicycle();
    }
}

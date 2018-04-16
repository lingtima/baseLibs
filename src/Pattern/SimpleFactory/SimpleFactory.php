<?php

namespace Tools\Pattern\SimpleFactory;

class SimpleFactory
{
    public function createBicycle()
    {
        return new Bicycle();
    }
}

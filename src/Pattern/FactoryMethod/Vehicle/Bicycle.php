<?php

namespace Tools\Pattern\FactoryMethod\Vehicle;

class Bicycle implements IVehicle
{
    private $color;
    
    public function setColor(string $rgb)
    {
        $this->color = $rgb;
    }
}

<?php

namespace Tools\Pattern\Creational\FactoryMethod\Vehicle;

class Bicycle implements IVehicle
{
    private $color;
    
    public function setColor(string $rgb)
    {
        $this->color = $rgb;
    }
}

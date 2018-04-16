<?php

namespace Tools\Pattern\Creational\FactoryMethod\Vehicle;

class CarFerrari implements IVehicle
{
    private $color;
    
    public function setColor(string $rgb)
    {
        $this->color = $rgb;
    }
}

<?php

namespace Tools\Pattern\FactoryMethod\Vehicle;

class CarFerrari implements IVehicle
{
    private $color;
    
    public function setColor(string $rgb)
    {
        $this->color = $rgb;
    }
}

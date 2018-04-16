<?php

namespace Tools\Pattern\Creational\FactoryMethod\Factory;

use Tools\Pattern\Creational\FactoryMethod\Vehicle\Bicycle;
use Tools\Pattern\Creational\FactoryMethod\Vehicle\CarFerrari;
use Tools\Pattern\Creational\FactoryMethod\Vehicle\IVehicle;

class ItalianFactory extends AFactoryMethod
{
    protected function createVehicle($type): IVehicle
    {
        switch ($type) {
            case parent::CHEAP:
                return new Bicycle();
            case parent::FAST:
                return new CarFerrari();
            default:
                throw new \InvalidArgumentException('$type is not a valid vehicle');
        }
    }
}

<?php

namespace Tools\Pattern\FactoryMethod\Factory;

use Tools\Pattern\FactoryMethod\Vehicle\Bicycle;
use Tools\Pattern\FactoryMethod\Vehicle\CarMercedes;
use Tools\Pattern\FactoryMethod\Vehicle\IVehicle;

class GermanFactory extends AFactoryMethod
{
    protected function createVehicle($type): IVehicle
    {
        switch ($type) {
            case parent::CHEAP:
                return new Bicycle();
            case parent::FAST:
                return new CarMercedes();
            default:
                throw new \InvalidArgumentException('$type is not a valid vehicle');
        }
    }
}

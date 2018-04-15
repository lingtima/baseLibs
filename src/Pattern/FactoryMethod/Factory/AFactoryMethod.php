<?php

namespace Tools\Pattern\FactoryMethod\Factory;

use Tools\Pattern\FactoryMethod\Vehicle\IVehicle;

abstract class AFactoryMethod
{
    const CHEAP = 'cheap';
    const FAST = 'fast';
    
    abstract protected function createVehicle($type): IVehicle;
    
    public function create($type)
    {
        $vehicle = $this->createVehicle($type);
        //TODO
        return $vehicle;
    }
}

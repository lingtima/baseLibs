<?php

namespace Tools\Tests\Pattern\FactoryMethod;

use Tools\Pattern\FactoryMethod\Factory\AFactoryMethod;
use Tools\Pattern\FactoryMethod\Factory\GermanFactory;
use Tools\Pattern\FactoryMethod\Factory\ItalianFactory;
use Tools\Pattern\FactoryMethod\Vehicle\Bicycle;
use Tools\Pattern\FactoryMethod\Vehicle\CarFerrari;
use Tools\Pattern\FactoryMethod\Vehicle\CarMercedes;
use Tools\Tests\TestCase;

class FactoryMethodTest extends TestCase
{
    public function testPattern()
    {
        $this->assertInstanceOf(CarMercedes::class, (new GermanFactory())->create(AFactoryMethod::FAST));
        
        $this->assertInstanceOf(Bicycle::class, (new GermanFactory())->create(AFactoryMethod::CHEAP));
        
        $this->assertInstanceOf(CarFerrari::class, (new ItalianFactory())->create(AFactoryMethod::FAST));
        
        $this->assertInstanceOf(Bicycle::class, (new ItalianFactory())->create(AFactoryMethod::CHEAP));
    }
}

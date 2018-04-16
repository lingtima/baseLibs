<?php

namespace Tools\Tests\Pattern\Creational\SimpleFactory;

use Tools\Pattern\Creational\SimpleFactory\Bicycle;
use Tools\Pattern\Creational\SimpleFactory\SimpleFactory;
use Tools\Tests\TestCase;

class SimpleFactoryTest extends TestCase
{
    public function testPattern()
    {
        $this->assertInstanceOf(Bicycle::class, (new SimpleFactory())->createBicycle());
    }
}

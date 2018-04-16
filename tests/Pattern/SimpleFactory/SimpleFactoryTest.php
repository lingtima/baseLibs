<?php

namespace Tools\Tests\SimpleFactory;

use Tools\Pattern\SimpleFactory\Bicycle;
use Tools\Pattern\SimpleFactory\SimpleFactory;
use Tools\Tests\TestCase;

class SimpleFactoryTest extends TestCase
{
    public function testPattern()
    {
        $this->assertInstanceOf(Bicycle::class, (new SimpleFactory())->createBicycle());
    }
}

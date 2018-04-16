<?php

namespace Tools\Tests\Pattern\Creational\Singleton;

use Tools\Pattern\Creational\Singleton\Singleton;
use Tools\Tests\TestCase;

class SingletonTest extends TestCase
{
    public function testPattern()
    {
        $Singleton = Singleton::getInstance();
        $this->assertInstanceOf(Singleton::class, $Singleton);
    }
}

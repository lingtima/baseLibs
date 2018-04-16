<?php

namespace Tools\Tests\Pattern\Singleton;

use Tools\Pattern\Singleton\Singleton;
use Tools\Tests\TestCase;

class SingletonTest extends TestCase
{
    public function testPattern()
    {
        $Singleton = Singleton::getInstance();
        $this->assertInstanceOf(Singleton::class, $Singleton);
    }
}

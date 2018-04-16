<?php

namespace Tools\Tests\Pattern\Creational\StaticFactory;

use Tools\Tests\TestCase;
use Tools\Pattern\Creational\StaticFactory\StaticFactory;
use Tools\Pattern\Creational\StaticFactory\FormatNumber;
use Tools\Pattern\Creational\StaticFactory\FormatString;

class StaticFactoryTest extends TestCase
{
    public function testPattern()
    {
        $this->assertInstanceOf(FormatNumber::class, StaticFactory::factory('number'));
        $this->assertInstanceOf(FormatString::class, StaticFactory::factory('string'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testException()
    {
        StaticFactory::factory('hello');
    }
}
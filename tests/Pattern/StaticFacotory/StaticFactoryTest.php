<?php

namespace Tools\Tests\Pattern\StaticFactory;

use Tools\Tests\TestCase;
use Tools\Pattern\StaticFactory\StaticFactory;
use Tools\Pattern\StaticFactory\FormatNumber;
use Tools\Pattern\StaticFactory\FormatString;

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
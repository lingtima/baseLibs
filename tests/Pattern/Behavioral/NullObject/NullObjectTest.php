<?php

namespace Tools\Tests\Pattern\Behavioral\NullObject;

use Tools\Pattern\Behavioral\NullObject\NullLogger;
use Tools\Pattern\Behavioral\NullObject\PrintLogger;
use Tools\Pattern\Behavioral\NullObject\Service;
use Tools\Tests\TestCase;

class NullObjectTest extends TestCase
{
    public function testNullObject()
    {
        $service = new Service(new NullLogger());
        
        $this->expectOutputString('');
        $service->doSomething();
    }
    
    public function testStandardLogger()
    {
        $service = new Service(new PrintLogger());
        $this->expectOutputString('We are in Tools\Pattern\Behavioral\NullObject\Service::doSomething');
        $service->doSomething();
    }
}

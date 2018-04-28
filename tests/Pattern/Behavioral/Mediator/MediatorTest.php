<?php

namespace Tools\Tests\Pattern\Behavioral\Mediator;

use Tools\Pattern\Behavioral\Mediator\Mediator;
use Tools\Pattern\Behavioral\Mediator\Subsystem\Client;
use Tools\Pattern\Behavioral\Mediator\Subsystem\Database;
use Tools\Pattern\Behavioral\Mediator\Subsystem\Server;
use Tools\Tests\TestCase;

class MediatorTest extends TestCase
{
    public function testPattern()
    {
        $client = new Client();
        new Mediator(new Database(), $client, new Server());
        
        $this->expectOutputString('Hello World');
        $client->request();
    }
}

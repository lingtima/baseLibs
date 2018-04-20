<?php

namespace Tools\Tests\Pattern\Behavioral\Command;

use Tools\Pattern\Behavioral\Command\HelloCommand;
use Tools\Pattern\Behavioral\Command\Invoker;
use Tools\Pattern\Behavioral\Command\Receiver;
use Tools\Tests\TestCase;

class CommandTest extends TestCase
{
    public function testPattern()
    {
        $invoker = new Invoker();
        $receiver = new Receiver();
        
        $invoker->setCommand(new HelloCommand($receiver));
        $invoker->run();
        $this->assertEquals('Hello World', $receiver->getOutput());
    }
}

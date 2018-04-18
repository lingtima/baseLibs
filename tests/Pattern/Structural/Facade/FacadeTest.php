<?php

namespace Tools\Tests\Pattern\Structural\Facade;

use Tools\Pattern\Structural\Facade\BiosInterface;
use Tools\Pattern\Structural\Facade\Facade;
use Tools\Pattern\Structural\Facade\OsInterface;
use Tools\Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testPattern()
    {
        $os = $this->createMock(OsInterface::class);
        
        $os->method('getName')->will($this->returnValue('Linux'));
        
//        $bios = $this->createMock(BiosInterface::class);
        $bios = $this->getMockBuilder(BiosInterface::class)
            ->setMethods(['launch', 'execute', 'waitForKeyPress'])
            ->disableAutoload()
            ->getMock();

        $bios->expects($this->once())->method('launch')->with($os);

        $facade = new Facade($os, $bios);
        
        $facade->turnOn();
        $this->assertEquals('Linux', $os->getName());
    }
}

<?php

namespace Tools\Tests\Pattern\Structural\Registry;

use Tools\Pattern\Structural\Registry\Registry;
use Tools\Tests\TestCase;

class RegistryTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testPattern()
    {
        $key = Registry::LOGGER;
        $logger = new \stdClass();
    
        Registry::set($key, $logger);
        $storedLogger = Registry::get($key);
    
        $this->assertSame($logger, $storedLogger);
        $this->assertInstanceOf(\stdClass::class, $storedLogger);
    }
    
    /**
     * @runInSeparateProcess
     * @expectedException \InvalidArgumentException
     */
    public function testSetException()
    {
        Registry::set('sdfs', 'lsls');
    }
    
    /**
     * @runInSeparateProcess
     * @expectedException \InvalidArgumentException
     */
    public function testGetException()
    {
        Registry::get('sdfasdfa');
    }
}

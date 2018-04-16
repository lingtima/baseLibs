<?php

namespace Tools\Tests\Pattern\Multiton;

use Tools\Pattern\Multiton\Multiton;
use Tools\Tests\TestCase;

class MultitonTest extends TestCase
{
    public function testPattern()
    {
        $Multiton1 = Multiton::getInstance('first');
        $Multiton2 = Multiton::getInstance('second');
        $Multiton3 = Multiton::getInstance('first');
        
        $this->assertTrue($Multiton1 === $Multiton3);
        $this->assertFalse($Multiton1 === $Multiton2);
    }
}

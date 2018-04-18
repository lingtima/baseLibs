<?php

namespace Tools\Tests\Pattern\Structural\Flyweight;

use Tools\Pattern\Structural\Flyweight\FlyweightFactory;
use Tools\Tests\TestCase;

class FlyweightTest extends TestCase
{
    private $characters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
        'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
    private $fonts = ['Arial', 'Times New Roman', 'Verdana', 'Helvetica'];
    
    public function testPattern()
    {
        $factory = new FlyweightFactory();
        
        foreach ($this->characters as $char)
        {
            foreach ($this->fonts as $font)
            {
                $flyweight = $factory->get($char);
                $render = $flyweight->render($font);
                
                $this->assertEquals(sprintf('Character %s with font %s', $char, $font), $render);
            }
        }
        
        $this->assertCount(count($this->characters), $factory);
    }
}

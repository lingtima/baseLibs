<?php

namespace Tools\Tests\Pattern\Structural\Bridge;

use Tools\Pattern\Structural\Bridge\HelloWorldService;
use Tools\Pattern\Structural\Bridge\HtmlFormatter;
use Tools\Pattern\Structural\Bridge\PlainTextFormatter;
use Tools\Tests\TestCase;

class BridgeTest extends TestCase
{
    public function testPattern()
    {
        $service = new HelloWorldService(new PlainTextFormatter());
        $this->assertEquals('Hello World', $service->get());
        
        $service->setImplementation(new HtmlFormatter());
        $this->assertEquals('<p>Hello World</p>', $service->get());
    }
}

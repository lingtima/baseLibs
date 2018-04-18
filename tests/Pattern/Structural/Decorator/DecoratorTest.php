<?php

namespace Tools\Tests\Pattern\Structural;

use Tools\Pattern\Structural\Decorator\JsonRenderer;
use Tools\Pattern\Structural\Decorator\Webservice;
use Tools\Pattern\Structural\Decorator\XmlRenderer;
use Tools\Tests\TestCase;

class DecoratorTest extends TestCase
{
    private $service;
    
    public function setUp()
    {
        $this->service = new Webservice('foobar');
    }
    
    public function testJsonDecorator()
    {
        $service = new JsonRenderer($this->service);
        $this->assertEquals('"foobar"', $service->renderData());
    }
    
    public function testXmlDecorator()
    {
        $service = new XmlRenderer($this->service);
        $this->assertXmlStringEqualsXmlString('<?xml version="1.0"?><content>foobar</content>', $service->renderData());
    }
}

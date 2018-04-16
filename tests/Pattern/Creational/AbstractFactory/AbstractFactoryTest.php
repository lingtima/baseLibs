<?php

namespace Tools\Tests\Pattern\Creational\AbstractFactory;

use Tools\Pattern\Creational\AbstractFactory\Factory\HtmlFactory;
use Tools\Pattern\Creational\AbstractFactory\Factory\JsonFactory;
use Tools\Pattern\Creational\AbstractFactory\Text\HtmlText;
use Tools\Pattern\Creational\AbstractFactory\Text\JsonText;
use Tools\Tests\TestCase;

class AbstractFactoryTest extends TestCase
{
    public function testPattern()
    {
        $this->assertInstanceOf(JsonText::class, (new JsonFactory())->createText('test'));
        $this->assertInstanceOf(HtmlText::class, (new HtmlFactory())->createText('test'));
    }
}

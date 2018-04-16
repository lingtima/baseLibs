<?php

namespace Tools\Tests\Pattern\AbstractFactory;

use Tools\Pattern\AbstractFactory\Factory\HtmlFactory;
use Tools\Pattern\AbstractFactory\Factory\JsonFactory;
use Tools\Pattern\AbstractFactory\Text\HtmlText;
use Tools\Pattern\AbstractFactory\Text\JsonText;
use Tools\Tests\TestCase;

class AbstractFactoryTest extends TestCase
{
    public function testPattern()
    {
        $this->assertInstanceOf(JsonText::class, (new JsonFactory())->createText('test'));
        $this->assertInstanceOf(HtmlText::class, (new HtmlFactory())->createText('test'));
    }
}

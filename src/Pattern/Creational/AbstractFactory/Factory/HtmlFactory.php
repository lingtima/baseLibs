<?php

namespace Tools\Pattern\Creational\AbstractFactory\Factory;

use Tools\Pattern\Creational\AbstractFactory\Text\HtmlText;

class HtmlFactory extends AbstractFactory
{
    public function createText(string $content)
    {
        return new HtmlText($content);
    }
}

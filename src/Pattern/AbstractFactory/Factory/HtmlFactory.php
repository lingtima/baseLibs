<?php

namespace Tools\Pattern\AbstractFactory\Factory;

use Tools\Pattern\AbstractFactory\Text\HtmlText;

class HtmlFactory extends AbstractFactory
{
    public function createText(string $content)
    {
        return new HtmlText($content);
    }
}

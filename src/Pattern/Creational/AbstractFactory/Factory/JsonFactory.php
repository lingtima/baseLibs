<?php

namespace Tools\Pattern\Creational\AbstractFactory\Factory;

use Tools\Pattern\Creational\AbstractFactory\Text\JsonText;

class JsonFactory extends AbstractFactory
{
    public function createText(string $content)
    {
        return new JsonText($content);
    }
}

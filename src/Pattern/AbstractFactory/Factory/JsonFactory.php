<?php

namespace Tools\Pattern\AbstractFactory\Factory;

use Tools\Pattern\AbstractFactory\Text\JsonText;

class JsonFactory extends AbstractFactory
{
    public function createText(string $content)
    {
        return new JsonText($content);
    }
}

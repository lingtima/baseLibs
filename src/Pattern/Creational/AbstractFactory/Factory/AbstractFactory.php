<?php

namespace Tools\Pattern\Creational\AbstractFactory\Factory;

abstract class AbstractFactory
{
    abstract public function createText(string $content);
}

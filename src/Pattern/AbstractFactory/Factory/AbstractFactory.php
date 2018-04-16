<?php

namespace Tools\Pattern\AbstractFactory\Factory;

abstract class AbstractFactory
{
    abstract public function createText(string $content);
}

<?php

namespace Tools\Pattern\Creational\AbstractFactory\Text;

abstract class Text
{
    private $text;
    
    public function __construct(string $text)
    {
        $this->text = $text;
    }
}

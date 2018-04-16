<?php

namespace Tools\Pattern\AbstractFactory\Text;

abstract class Text
{
    private $text;
    
    public function __construct(string $text)
    {
        $this->text = $text;
    }
}

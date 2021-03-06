<?php

namespace Tools\Pattern\Structural\Composite;

class TextElement implements RenderableInterface
{
    private $text;
    
    public function __construct(string $text)
    {
        $this->text = $text;
    }
    
    public function render(): string
    {
        return $this->text;
    }
}
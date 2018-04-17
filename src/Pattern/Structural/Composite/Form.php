<?php

namespace Tools\Pattern\Structural\Composite;

class Form implements RenderableInterface
{
    /**
     * @var array $elements
     */
    private $elements;
    
    public function render(): string
    {
        $formCode = '<form>';
        
        foreach ($this->elements as $element) {
            $formCode .= $element->render();
        }
        $formCode .= '</form>';
        
        return $formCode;
    }
    
    public function addElement(RenderableInterface $element)
    {
        $this->elements[] = $element;
    }
}

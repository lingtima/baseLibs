<?php

namespace Tools\Pattern\Structural\Decorator;

class JsonRenderer extends RendererDecorator
{
    public function renderData(): string
    {
        return json_encode($this->wrapped->renderData());
    }
}

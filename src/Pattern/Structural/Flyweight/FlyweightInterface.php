<?php

namespace Tools\Pattern\Structural\Flyweight;

interface FlyweightInterface
{
    public function render(string $extrinsicState): string;
}
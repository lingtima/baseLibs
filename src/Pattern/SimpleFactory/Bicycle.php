<?php

namespace Tools\Pattern\SimpleFactory;

class Bicycle
{
    public function driveTo(string $destination)
    {
        return $destination;
    }
}

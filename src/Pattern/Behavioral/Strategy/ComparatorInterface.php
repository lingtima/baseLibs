<?php

namespace Tools\Pattern\Behavioral\Strategy;

interface ComparatorInterface
{
    public function compare($a, $b): int;
}

<?php

namespace Tools\Pattern\Behavioral\NullObject;

class PrintLogger implements LoggerInterface
{
    public function log(string $str)
    {
        echo $str;
    }
}

<?php

namespace Tools\Pattern\Creational\Pool;

class StringReverseWorker
{
    private $createAt;
    
    public function __construct()
    {
        $this->createAt = new \DateTime();
    }
    
    public function run(string $text)
    {
        return strrev($text);
    }
}

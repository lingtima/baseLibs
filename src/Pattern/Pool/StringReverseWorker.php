<?php

namespace Tools\Pattern\Pool;

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

<?php

namespace Tools\Pattern\Structural\Facade;

interface OsInterface
{
    public function halt();
    
    public function getName(): string;
}

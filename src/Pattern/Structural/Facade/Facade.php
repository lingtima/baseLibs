<?php

namespace Tools\Pattern\Structural\Facade;

class Facade
{
    private $os;
    
    private $bios;
    
    public function __construct(OsInterface $os, BiosInterface $bios)
    {
        $this->os = $os;
        $this->bios = $bios;
    }
    
    public function turnOn()
    {
        $this->bios->execute();
        $this->bios->waitForKeyPress();
        $this->bios->launch($this->os);
    }
    
    public function turnOff()
    {
        $this->os->halt();
        $this->bios->powerDown();
    }
}

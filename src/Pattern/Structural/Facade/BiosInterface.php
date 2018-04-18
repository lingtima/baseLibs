<?php

namespace Tools\Pattern\Structural\Facade;

interface BiosInterface
{
    public function execute();
    
    public function waitForKeyPress();
    
    public function launch(OsInterface $os);
    
    public function powerDown();
}

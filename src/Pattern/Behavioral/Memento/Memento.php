<?php

namespace Tools\Pattern\Behavioral\Memento;

class Memento
{
    private $state;
    
    public function __construct(State $stateToSave)
    {
        $this->state = $stateToSave;
    }
    
    public function getState()
    {
        return $this->state;
    }
}

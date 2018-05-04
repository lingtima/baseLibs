<?php

namespace Tools\Pattern\Behavioral\State;

abstract class StateOrder
{
    private $details;
    
    /**
     * @var StateOrder
     */
    protected static $state;
    
    abstract protected function done();
    
    protected function setStatus(string $status)
    {
        $this->details['status'] = $status;
        $this->details['updateTime'] = time();
    }
    
    protected function getStatus()
    {
        return $this->details['status'];
    }
}

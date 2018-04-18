<?php

namespace Tools\Pattern\Structural\Proxy;

class RecordProxy extends Record
{
    private $isDirty = false;
    
    private $isInitialize = false;
    
    public function __construct(array $data)
    {
        parent::__construct($data);
        
        if (count($data) > 0) {
            $this->isDirty = true;
            $this->isInitialize = true;
        }
    }
    
    public function __set(string $name, string $value)
    {
        $this->isDirty = true;
        parent::__set($name, $value);
    }
    
    public function isDirty(): bool
    {
        return $this->isDirty;
    }
}

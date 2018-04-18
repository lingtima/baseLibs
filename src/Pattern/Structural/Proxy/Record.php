<?php

namespace Tools\Pattern\Structural\Proxy;

class Record
{
    private $data;
    
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }
    
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
    
    public function __set(string $name, string $value)
    {
        $this->data[$name] = $value;
    }
    
    public function __get(string $name)
    {
        if (!isset($this->data[$name])) {
            throw new \InvalidArgumentException('Invalid name given');
        }
        
        return $this->data[$name];
    }
}

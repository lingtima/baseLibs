<?php

namespace Tools\Pattern\Creational\Builder\Builder;

use Tools\Pattern\Creational\Builder\User\Visitor;

class VisitorBuilder implements IBuilder
{
    public $visitor;
    
    public function createUser($userId = '')
    {
        $this->visitor = new Visitor($userId);
    }
    
    public function getUser()
    {
        return $this->visitor;
    }
}

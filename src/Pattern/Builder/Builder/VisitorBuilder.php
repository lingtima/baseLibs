<?php

namespace Tools\Pattern\Builder\Builder;

use Tools\Pattern\Builder\User\Visitor;

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
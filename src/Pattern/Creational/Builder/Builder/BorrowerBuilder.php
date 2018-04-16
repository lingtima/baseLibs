<?php

namespace Tools\Pattern\Creational\Builder\Builder;

use Tools\Pattern\Creational\Builder\User\Borrower;

class BorrowerBuilder implements IBuilder
{
    public $borrower;
    
    public function createUser($userId = '')
    {
        $this->borrower = new Borrower($userId);
    }
    
    public function getUser()
    {
        return $this->borrower;
    }
}

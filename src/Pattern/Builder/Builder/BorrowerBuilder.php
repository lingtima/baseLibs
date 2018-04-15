<?php

namespace Tools\Pattern\Builder\Builder;

use Tools\Pattern\Builder\User\Borrower;

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

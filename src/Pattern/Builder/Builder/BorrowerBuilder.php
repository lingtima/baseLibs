<?php

namespace Lingance\Pattern\Builder\Builder;

use Lingance\Pattern\Builder\User\Borrower;

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

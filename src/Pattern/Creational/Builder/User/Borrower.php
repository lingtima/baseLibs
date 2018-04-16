<?php

namespace Tools\Pattern\Creational\Builder\User;

class Borrower extends AUser
{
    protected $userId;
    
    public function __construct($borrowerId)
    {
        $this->userId = $borrowerId;
    }
    
    public function signIn()
    {
        echo 'borrower SingIn with userId:' . $this->userId . "\n";
    }
}

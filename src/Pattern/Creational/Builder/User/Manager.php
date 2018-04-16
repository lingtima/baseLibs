<?php

namespace Tools\Pattern\Creational\Builder\User;

class Manager extends AUser
{
    
    protected $userId;
    
    public function __construct($managerId)
    {
        $this->userId = $managerId;
    }
    
    public function signIn()
    {
        echo 'manager SingIn with userId:' . $this->userId . "\n";
    }
}

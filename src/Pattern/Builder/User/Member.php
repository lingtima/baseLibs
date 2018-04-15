<?php

namespace Tools\Pattern\Builder\User;

class Member extends AUser
{
    
    protected $userId;
    
    public function __construct($memberId)
    {
        $this->userId = $memberId;
    }
    
    public function signIn()
    {
        echo 'member SingIn with userId:' . $this->userId . "\n";
    }
}

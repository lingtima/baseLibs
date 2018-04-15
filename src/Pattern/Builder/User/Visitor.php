<?php

namespace Lingance\Pattern\Builder\User;

class Visitor extends AUser
{
    protected $userId;
    
    public function __construct($visitorId)
    {
        $this->userId = $visitorId;
    }
    
    public function signIn()
    {
        echo 'visitor SingIn with userId:' . $this->userId . "\n";
    }
}
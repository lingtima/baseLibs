<?php

namespace Tools\Pattern\Creational\Builder\Builder;

use Tools\Pattern\Creational\Builder\User\Member;

class MemberBuilder implements IBuilder
{
    public $member;
    
    public function createUser($userId = '')
    {
        $this->member = new Member($userId);
    }
    
    public function getUser()
    {
        return $this->member;
    }
}

<?php

namespace Tools\Pattern\Builder\Builder;

use Tools\Pattern\Builder\User\Member;

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

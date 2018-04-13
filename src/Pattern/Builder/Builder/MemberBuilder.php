<?php

namespace Lingance\Pattern\Builder\Builder;

use Lingance\Pattern\Builder\User\Member;

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

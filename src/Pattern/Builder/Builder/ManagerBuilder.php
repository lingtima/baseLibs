<?php

namespace Tools\Pattern\Builder\Builder;

use Tools\Pattern\Builder\User\Manager;

class ManagerBuilder implements IBUilder
{
    public $manager;
    
    public function createUser($userId = '')
    {
        $this->manager = new Manager($userId);
    }
    
    public function getUser()
    {
        return $this->manager;
    }
}

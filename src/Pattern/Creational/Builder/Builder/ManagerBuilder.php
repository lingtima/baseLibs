<?php

namespace Tools\Pattern\Creational\Builder\Builder;

use Tools\Pattern\Creational\Builder\User\Manager;

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

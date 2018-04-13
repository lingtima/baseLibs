<?php

namespace Lingance\Pattern\Builder\Builder;

use Lingance\Pattern\Builder\User\Manager;

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

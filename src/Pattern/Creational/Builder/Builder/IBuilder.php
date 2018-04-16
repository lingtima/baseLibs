<?php

namespace Tools\Pattern\Creational\Builder\Builder;

use Tools\Pattern\Creational\Builder\User\AUser;

interface IBuilder
{
    public function createUser($userId = '');
    
    /**
     * @return AUser|mixed
     */
    public function getUser();
}

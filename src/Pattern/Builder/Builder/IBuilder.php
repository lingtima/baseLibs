<?php

namespace Tools\Pattern\Builder\Builder;

use Tools\Pattern\Builder\User\AUser;

interface IBuilder
{
    public function createUser($userId = '');
    
    /**
     * @return AUser|mixed
     */
    public function getUser();
}

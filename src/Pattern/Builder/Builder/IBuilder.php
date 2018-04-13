<?php

namespace Lingance\Pattern\Builder\Builder;

use Lingance\Pattern\Builder\User\AUser;

interface IBuilder
{
    public function createUser($userId = '');
    
    /**
     * @return AUser|mixed
     */
    public function getUser();
}

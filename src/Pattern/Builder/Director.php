<?php

namespace Tools\Pattern\Builder;

use Tools\Pattern\Builder\Builder\IBuilder;

class Director
{
    /**
     * @param IBuilder $builder
     * @param string $userId
     * @return User\AUser|mixed
     */
    public function build(IBuilder $builder, $userId = '')
    {
        $builder->createUser($userId);
        return $builder->getUser();
    }
}

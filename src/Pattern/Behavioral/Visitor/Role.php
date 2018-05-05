<?php

namespace Tools\Pattern\Behavioral\Visitor;

interface Role
{
    public function accept(RoleVisitorInterface $visitor);
}

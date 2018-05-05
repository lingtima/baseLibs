<?php

namespace Tools\Pattern\Behavioral\Visitor;

/**
 * 注意，访问者不能自主选择调用那个方法
 * 它是由visitors决定的
 *
 * @package Tools\Pattern\Behavioral\Visitor
 */
interface RoleVisitorInterface
{
    public function visitUser(User $role);
    
    public function visitGroup(Group $role);
}

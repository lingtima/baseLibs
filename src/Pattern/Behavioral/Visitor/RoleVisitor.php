<?php

namespace Tools\Pattern\Behavioral\Visitor;

class RoleVisitor implements RoleVisitorInterface
{
    /**
     * @var Role[]
     */
    private $visited = [];
    
    public function visitGroup(Group $role)
    {
        $this->visited[] = $role;
    }
    
    public function visitUser(User $role)
    {
        $this->visited[] = $role;
    }
    
    public function getVisited(): array
    {
        return $this->visited;
    }
}

<?php

namespace Tools\Tests\Pattern\Behavioral\Visitor;

use Tools\Pattern\Behavioral\Visitor\Group;
use Tools\Pattern\Behavioral\Visitor\Role;
use Tools\Pattern\Behavioral\Visitor\RoleVisitor;
use Tools\Pattern\Behavioral\Visitor\User;
use Tools\Tests\TestCase;

class VisitorTest extends TestCase
{
    /**
     * @var RoleVisitor
     */
    private $visitor;
    
    protected function setUp()
    {
        $this->visitor = new RoleVisitor();
    }
    
    public function provideRoles()
    {
        return [
            [new User('Dominik')],
            [new Group('Administrators')],
        ];
    }
    
    /**
     * @dataProvider provideRoles
     *
     * @param Role $role
     */
    public function testVisitSomeRole(Role $role)
    {
        $role->accept($this->visitor);
        
        $this->assertSame($role, $this->visitor->getVisited()[0]);
    }
}

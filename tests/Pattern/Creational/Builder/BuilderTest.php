<?php

namespace Tools\Tests\Pattern\Creational\Builder;

use Tools\Pattern\Creational\Builder\Builder\BorrowerBuilder;
use Tools\Pattern\Creational\Builder\Builder\ManagerBuilder;
use Tools\Pattern\Creational\Builder\Builder\MemberBuilder;
use Tools\Pattern\Creational\Builder\Builder\VisitorBuilder;
use Tools\Pattern\Creational\Builder\Director;
use Tools\Pattern\Creational\Builder\User\Borrower;
use Tools\Pattern\Creational\Builder\User\Manager;
use Tools\Pattern\Creational\Builder\User\Member;
use Tools\Pattern\Creational\Builder\User\Visitor;
use Tools\Tests\TestCase;

class BuilderTest extends TestCase
{
    public function testPattern()
    {
        $userId = '089c780aad9719eb94c06ca2';
        $Director = new Director();
        $BorrowerBuilder = new BorrowerBuilder();
        $MemberBuilder = new MemberBuilder();
        $ManagerBuilder = new ManagerBuilder();
        $VisitorBuilder = new VisitorBuilder();
        
        $this->assertInstanceOf(Borrower::class, $Director->build($BorrowerBuilder, $userId));
        $this->assertInstanceOf(Member::class, $Director->build($MemberBuilder, $userId));
        $this->assertInstanceOf(Manager::class, $Director->build($ManagerBuilder, $userId));
        $this->assertInstanceOf(Visitor::class, $Director->build($VisitorBuilder, $userId));
    }
}

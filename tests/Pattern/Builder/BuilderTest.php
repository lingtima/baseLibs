<?php

namespace Tools\Tests\Pattern\Builder;

use Tools\Pattern\Builder\Builder\BorrowerBuilder;
use Tools\Pattern\Builder\Builder\ManagerBuilder;
use Tools\Pattern\Builder\Builder\MemberBuilder;
use Tools\Pattern\Builder\Builder\VisitorBuilder;
use Tools\Pattern\Builder\Director;
use Tools\Pattern\Builder\User\Borrower;
use Tools\Pattern\Builder\User\Manager;
use Tools\Pattern\Builder\User\Member;
use Tools\Pattern\Builder\User\Visitor;
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

<?php

namespace Tools\Tests\Pattern\More\Delegation;

use Tools\Pattern\More\Delegation\JuniorDeveloper;
use Tools\Pattern\More\Delegation\TeamLead;
use Tools\Tests\TestCase;

class DelegationTest extends TestCase
{
    public function testHowTeamLeadWriteCode()
    {
        $junior = new JuniorDeveloper();
        $teamLead = new TeamLead($junior);
        
        $this->assertEquals($junior->writeBadCode(), $teamLead->writeCode());
    }
}

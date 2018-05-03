<?php

namespace Tools\Tests\Pattern\Behavioral\Observer;

use Tools\Pattern\Behavioral\Observer\User;
use Tools\Pattern\Behavioral\Observer\UserObserver;
use Tools\Tests\TestCase;

class ObserverTest extends TestCase
{
    public function testChangeInUserLeadsToUserObserverBeingNotified()
    {
        $observer = new UserObserver();
        
        $user = new User();
        $user->attach($observer);
        
        $user->changeEmail('foo@bar.com');
        $this->assertCount(1, $observer->getChangedUsers());
    }
}

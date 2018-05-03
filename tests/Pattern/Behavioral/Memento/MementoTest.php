<?php

namespace Tools\Tests\Pattern\Behavioral\Memento;

use Tools\Pattern\Behavioral\Memento\State;
use Tools\Pattern\Behavioral\Memento\Ticket;
use Tools\Tests\TestCase;

class MementoTest extends TestCase
{
    public function testOpenTicketAssignAndSetBackToOpen()
    {
        $ticket = new Ticket();
        
        $ticket->open();
        
        $openState = $ticket->getState();
        $this->assertEquals(State::STATE_OPENED, (string)$ticket->getState());
        
        $memento = $ticket->saveToMemento();
        
        $ticket->assign();
        $this->assertEquals(State::STATE_ASSIGNED, (string)$ticket->getState());
        
        $ticket->restoreToMemento($memento);
        $this->assertEquals(State::STATE_OPENED, (string)$ticket->getState());
        $this->assertNotSame($openState, $ticket->getState());
    }
}

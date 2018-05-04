<?php

namespace Tools\Tests\Pattern\Behavioral\State;

use Tools\Pattern\Behavioral\State\ContextOrder;
use Tools\Pattern\Behavioral\State\CreateOrder;
use Tools\Tests\TestCase;

class StateTest extends TestCase
{
    public function testCanShipCreateOrder()
    {
        $order = new CreateOrder();
        $contextOrder = new ContextOrder();
        $contextOrder->setState($order);
        $contextOrder->done();
        
        $this->assertEquals('shipping', $contextOrder->getStatus());
    }
    
    public function testCanCompleteShippedOrder()
    {
        $order = new CreateOrder();
        $contextOrder = new ContextOrder();
        $contextOrder->setState($order);
        
        $contextOrder->done();
        $contextOrder->done();
        
        $this->assertEquals('complete', $contextOrder->getStatus());
    }
}

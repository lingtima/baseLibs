<?php

namespace Tools\Pattern\Behavioral\State;

class ShippingOrder extends StateOrder
{
    public function __construct()
    {
        $this->setStatus('shipping');
    }
    
    protected function done()
    {
        $this->setStatus('complete');
    }
}

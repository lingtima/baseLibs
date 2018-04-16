<?php

namespace Tools\Tests\Pattern\Pool;

use Tools\Tests\TestCase;
use Tools\Pattern\Pool\WorkerPool;

class PoolTest extends TestCase
{
    public function testPattern()
    {
        $WorkerPool = new WorkerPool();
        $worker1 = $WorkerPool->get();
        $worker2 = $WorkerPool->get();
        $worker3 = $WorkerPool->get();

        $WorkerPool->dispose($worker1);
        $WorkerPool->dispose($worker3);

        $worker4 = $WorkerPool->get();
        $worker5 = $WorkerPool->get();

        $this->assertFalse($worker1 === $worker2);
        $this->assertFalse($worker2 === $worker3);
        $this->assertFalse($worker4 === $worker5);
        $this->assertTrue($worker1 === $worker5);
        $this->assertTrue($worker3 === $worker4);
    }
}
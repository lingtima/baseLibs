<?php

namespace Tools\Tests\Pattern\Structural\DependencyInjection;

use Tools\Pattern\Structural\DependencyInjection\DatabaseConfiguration;
use Tools\Pattern\Structural\DependencyInjection\DatabaseConnection;
use Tools\Tests\TestCase;

class DependencyInjectionTest extends TestCase
{
    public function testPattern()
    {
        $config = new DatabaseConfiguration('localhost', '3316', 'root', '');
        $connection = new DatabaseConnection($config);
        
        $this->assertEquals('root:@localhost:3316', $connection->getDsn());
    }
}

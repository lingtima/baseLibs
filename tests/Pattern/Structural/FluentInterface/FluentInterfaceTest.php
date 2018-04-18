<?php

namespace Tools\Tests\Pattern\Structural\FluentInterface;

use Tools\Pattern\Structural\FluentInterface\Sql;
use Tools\Tests\TestCase;

class FluentInterfaceTest extends TestCase
{
    public function testPattern()
    {
        $query = (new Sql())
            ->select(['foo', 'bar'])
            ->from('foobar', 'f')
            ->where('f.bar = ?');
        
        $this->assertEquals('SELECT foo,bar FROM foobar AS f WHERE f.bar = ?', (string)$query);
    }
}

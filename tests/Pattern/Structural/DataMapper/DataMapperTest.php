<?php

namespace Tools\Tests\Pattern\Structural\DataMapper;

use Tools\Pattern\Structural\DataMapper\StorageAdapter;
use Tools\Pattern\Structural\DataMapper\User;
use Tools\Pattern\Structural\DataMapper\UserMapper;
use Tools\Tests\TestCase;

class DataMapperTest extends TestCase
{
    public function testPattern()
    {
        $storage = new StorageAdapter([1 => ['username' => 'lyq', 'email' => 'lingtima@gmail.com']]);
        $mapper = new UserMapper($storage);
        
        $user = $mapper->findById(1);
        $this->assertInstanceOf(User::class, $user);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWillNotMapInvalidData()
    {
        $storage = new StorageAdapter([]);
        $mapper = new UserMapper($storage);
        
        $mapper->findById(1);
    }
}

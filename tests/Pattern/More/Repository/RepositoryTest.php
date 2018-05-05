<?php

namespace Tools\Tests\Pattern\More\Repository;

use Tools\Pattern\More\Repository\MemoryStorage;
use Tools\Pattern\More\Repository\Post;
use Tools\Pattern\More\Repository\PostRepository;
use Tools\Tests\TestCase;

class RepositoryTest extends TestCase
{
    public function testCanPersistAndFindPost()
    {
        $repository = new PostRepository(new MemoryStorage());
        $post = new Post(null, 'Repository Pattern', 'Design Patterns PHP');
        
        $repository->save($post);
        
        $this->assertEquals(1, $post->getId());
        $this->assertEquals($post->getId(), $repository->findById(1)->getId());
    }
}

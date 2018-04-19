<?php

namespace Tools\Tests\Pattern\Behavioral\ChainOfResponsibilities;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use Tools\Pattern\Behavioral\ChainOfResponsibilities\Handler;
use Tools\Pattern\Behavioral\ChainOfResponsibilities\HttpInMemoryCacheHandler;
use Tools\Pattern\Behavioral\ChainOfResponsibilities\SlowDatabaseHandler;
use Tools\Tests\TestCase;

class ChainTest extends TestCase
{
    /**
     * @var Handler
     */
    private $chain;
    
    protected function setUp()
    {
        $this->chain = new HttpInMemoryCacheHandler(['/foo/bar?index=1' => 'Hello In Memory'], new SlowDatabaseHandler());
    }
    
    public function testCanRequestKeyInFastStorage()
    {
        $uri = $this->createMock(UriInterface::class);
        $uri->method('getPath')->willReturn('/foo/bar');
        $uri->method('getQuery')->willReturn('index=1');
        
        $request = $this->createMock(RequestInterface::class);
        $request->method('getMethod')->willReturn('GET');
        $request->method('getUri')->willReturn($uri);
        
        $this->assertEquals('Hello In Memory', $this->chain->handle($request));
    }
    
    public function testCanRequestKeyInSlowStorage()
    {
        $uri = $this->createMock(UriInterface::class);
        $uri->method('getPath')->willReturn('/foo/baz');
        $uri->method('getQuery')->willReturn('');
        
        $request = $this->createMock(RequestInterface::class);
        $request->method('getMethod')->willReturn('GET');
        $request->method('getUri')->willReturn($uri);
        
        $this->assertequals('Hello World', $this->chain->handle($request));
    }
}

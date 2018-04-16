<?php

namespace Tools\Tests\Pattern\Prototype;

use Tools\Tests\TestCase;
use Tools\Pattern\Prototype\BarBookPrototype;
use Tools\Pattern\Prototype\FooBookPrototype;

class PrototypeTest extends TestCase
{
    public function testPattern()
    {
        $FooPrototype = new FooBookPrototype();
        $BarPrototype = new BarBookPrototype();

        for ($i = 0; $i < 10; $i++) {
            $book = clone $FooPrototype;
            $book->setTitle('Foo book No ' . $i);
            $this->assertInstanceOf(FooBookPrototype::class, $book);
        }

        for ($i = 0; $i < 10; $i++) {
            $book = clone $BarPrototype;
            $book->setTitle('Bar book No ' . $i);
            $this->assertInstanceOf(BarBookPrototype::class, $book);
        }
    }
}
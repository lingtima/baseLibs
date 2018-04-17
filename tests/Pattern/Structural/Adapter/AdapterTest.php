<?php

namespace Tools\Tests\Pattern\Structural\Adapter;

use Tools\Pattern\Structural\Adapter\Book;
use Tools\Pattern\Structural\Adapter\EBookAdapter;
use Tools\Pattern\Structural\Adapter\Kindle;
use Tools\Tests\TestCase;

class AdapterTest extends TestCase
{
    public function testPattern()
    {
        $Book = new Book();
        $Book->open();
        $Book->turnPage();
        $this->assertEquals(2, $Book->getPage());
        
        $Kindle = new Kindle();
        unset($Book);
        $Book = new EBookAdapter($Kindle);
        $Book->open();
        $Book->turnPage();
        $this->assertEquals(2, $Book->getPage());
    }
}

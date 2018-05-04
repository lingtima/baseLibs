<?php

namespace Tools\Tests\Pattern\Behavioral\Strategy;

use Tools\Pattern\Behavioral\Strategy\Context;
use Tools\Pattern\Behavioral\Strategy\DateComparator;
use Tools\Pattern\Behavioral\Strategy\IdComparator;
use Tools\Tests\TestCase;

class StrategyTest extends TestCase
{
    public function provideIntegers()
    {
        return [
            [
                [['id' => 2], ['id' => 1], ['id' => 3]],
                ['id' => 1],
            ],
            [
                [['id' => 3], ['id' => 2], ['id' => 1]],
                ['id' => 1],
            ],
        ];
    }
    
    public function provideDates()
    {
        return [
            [
                [['date' => '2014-03-03'], ['date' => '2015-03-02'], ['date' => '2013-03-01']],
                ['date' => '2013-03-01'],
            ],
            [
                [['date' => '2014-02-03'], ['date' => '2013-02-01'], ['date' => '2015-02-02']],
                ['date' => '2013-02-01'],
            ],
        ];
    }
    
    /**
     * @dataProvider provideIntegers
     *
     * @param $collection
     * @param $expected
     */
    public function testIdComparator($collection, $expected)
    {
        $obj = new Context(new IdComparator());
        $elements = $obj->executeStrategy($collection);
        
        $firstElement = array_shift($elements);
        $this->assertEquals($expected, $firstElement);
    }
    
    /**
     * @dataProvider provideDates
     *
     * @param $collection
     * @param $expected
     */
    public function testDateComparator($collection, $expected)
    {
        $obj = new Context(new DateComparator());
        $elements = $obj->executeStrategy($collection);
        
        $firstElement = array_shift($elements);
        $this->assertEquals($expected, $firstElement);
    }
}

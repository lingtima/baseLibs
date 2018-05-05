<?php

namespace Tools\Tests\Pattern\Behavioral\TemplateMethod;

use Tools\Pattern\Behavioral\TemplateMethod\BeachJourney;
use Tools\Pattern\Behavioral\TemplateMethod\CityJourney;
use Tools\Tests\TestCase;

class TemplateMethodTest extends TestCase
{
    public function testCanGetOnVacationOnTheBeach()
    {
        $beachJourney = new BeachJourney();
        $beachJourney->takeATrip();
        
        $this->assertEquals(
            [
                'Buy a flight ticket',
                'Taking the plane',
                'Swimming and sun-bathing',
                'Taking the plane',
            ],
            $beachJourney->getThingsToDo()
        );
    }
    
    public function testCanGetOnAJourneyToACity()
    {
        $cityJourney = new CityJourney();
        $cityJourney->takeATrip();
        
        $this->assertEquals(
            [
                'Buy a flight ticket',
                'Taking the plane',
                'Eat, drink, take photos and sleep',
                'Buy a gift',
                'Taking the plane',
            ],
            $cityJourney->getThingsToDo()
        );
    }
}

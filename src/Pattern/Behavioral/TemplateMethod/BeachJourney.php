<?php

namespace Tools\Pattern\Behavioral\TemplateMethod;

class BeachJourney extends Journey
{
    protected function enjoyVacation(): string
    {
        return 'Swimming and sun-bathing';
    }
}

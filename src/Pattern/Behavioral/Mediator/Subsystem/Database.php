<?php

namespace Tools\Pattern\Behavioral\Mediator\Subsystem;

use Tools\Pattern\Behavioral\Mediator\Colleague;

class Database extends Colleague
{
    public function getData(): string
    {
        return 'World';
    }
}

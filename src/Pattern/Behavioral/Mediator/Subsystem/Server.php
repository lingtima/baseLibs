<?php

namespace Tools\Pattern\Behavioral\Mediator\Subsystem;

use Tools\Pattern\Behavioral\Mediator\Colleague;

class Server extends Colleague
{
    public function process()
    {
        $data = $this->mediator->queryDb();
        $this->mediator->sendResponse(sprintf('Hello %s', $data));
    }
}

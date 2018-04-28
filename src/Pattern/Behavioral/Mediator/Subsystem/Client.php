<?php

namespace Tools\Pattern\Behavioral\Mediator\Subsystem;

use Tools\Pattern\Behavioral\Mediator\Colleague;

/**
 * Client 类是一个发出请求并获得响应的类
 * @package Tools\Pattern\Behavioral\Mediator\Subsystem
 */
class Client extends Colleague
{
    public function request()
    {
        $this->mediator->makeRequest();
    }
    
    public function output(string $content)
    {
        echo $content;
    }
}
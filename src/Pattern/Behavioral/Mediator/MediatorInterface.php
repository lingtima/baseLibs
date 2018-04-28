<?php

namespace Tools\Pattern\Behavioral\Mediator;

interface MediatorInterface
{
    public function makeRequest();
    
    public function sendResponse($content);
    
    public function queryDb();
}

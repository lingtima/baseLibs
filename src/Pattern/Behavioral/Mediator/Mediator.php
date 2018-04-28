<?php

namespace Tools\Pattern\Behavioral\Mediator;

use Tools\Pattern\Behavioral\Mediator\Subsystem\Client;
use Tools\Pattern\Behavioral\Mediator\Subsystem\Database;
use Tools\Pattern\Behavioral\Mediator\Subsystem\Server;

/**
 * 中介者 Mediator
 * 是用于访问中介者模式的实体
 *
 * 这里用Mediator做了一个 Hello World 的响应
 *
 * @package Tools\Pattern\Behavioral\Mediator
 */
class Mediator implements MediatorInterface
{
    private $server;
    
    private $database;
    
    private $client;
    
    public function __construct(Database $database, Client $client, Server $server)
    {
        $this->server = $server;
        $this->database = $database;
        $this->client = $client;
        
        $this->server->setMediator($this);
        $this->database->setMediator($this);
        $this->client->setMediator($this);
    }
    
    public function makeRequest()
    {
        $this->server->process();
    }
    
    public function queryDb()
    {
        return $this->database->getData();
    }
    
    public function sendResponse($content)
    {
        $this->client->output($content);
    }
}

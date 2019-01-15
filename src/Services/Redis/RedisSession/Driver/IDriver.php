<?php

namespace Tools\Services\RedisSession\Driver;

interface IDriver
{
    public function open();
    
    public function close();
    
    public function read($sessionId);
    
    public function write($sessionId, $data);
    
    public function destroy($sessionId);
    
    public function gc();
}
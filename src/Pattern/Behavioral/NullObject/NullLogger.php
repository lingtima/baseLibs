<?php

namespace Tools\Pattern\Behavioral\NullObject;

/**
 * 创建一个空日记类实现日记接口
 * @package Tools\Pattern\Behavioral\NullObject
 */
class NullLogger implements LoggerInterface
{
    public function log(string $str)
    {
    
    }
}

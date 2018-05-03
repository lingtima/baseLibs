<?php

namespace Tools\Pattern\Behavioral\NullObject;

/**
 * 重要特征：控日志必须像其他日志意向从这个接口继承
 * @package Tools\Pattern\Behavioral\NullObject
 */
interface LoggerInterface
{
    public function log(string $str);
}

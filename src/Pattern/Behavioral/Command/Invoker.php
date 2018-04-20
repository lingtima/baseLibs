<?php

namespace Tools\Pattern\Behavioral\Command;

/**
 * 调用者使用这个命令
 * 比例：一个在SF2中的应用
 * Class Invoker
 * @package Tools\Pattern\Behavioral\Command
 */
class Invoker
{
    /**
     * @var CommandInterface
     */
    private $command;
    
    /**
     * 在这种调用者中，我们发现，订阅命令也是这种方法
     * 还包括：堆栈、列表、集合等等
     * @param CommandInterface $cmd
     */
    public function setCommand(CommandInterface $cmd)
    {
        $this->command = $cmd;
    }
    
    /**
     * 执行这个命令
     * 调用者也是用这个命令
     */
    public function run()
    {
        $this->command->execute();
    }
}

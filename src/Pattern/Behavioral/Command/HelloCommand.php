<?php

namespace Tools\Pattern\Behavioral\Command;

/**
 * 这个具体命令，在接收器上调用 print
 * 但是外部调用者只知道，这个是否可以执行
 * Class HelloCommand
 * @package Tools\Pattern\Behavioral\Command
 */
class HelloCommand implements CommandInterface
{
    private $output;
    
    /**
     * 每个具体的命令都来自于不同的接收者
     * 这里可以是一个或者多个接收者，但是参数里必须是可以被执行的命令。
     * HelloCommand constructor.
     * @param Receiver $console
     */
    public function __construct(Receiver $console)
    {
        $this->output = $console;
    }
    
    /**
     * 执行和输出
     */
    public function execute()
    {
        //有时候，这里没有接收者，并且这个命令执行所有工作
        $this->output->write('Hello World');
    }
}

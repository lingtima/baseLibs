<?php

namespace Tools\Pattern\Behavioral\Command;

/**
 * 接收方是特定的服务，有自己的contract，只能是具体的实例
 * Class Receiver
 * @package Tools\Pattern\Behavioral\Command
 */
class Receiver
{
    private $enableDate = false;
    
    private $output = [];
    
    public function write(string $str)
    {
        if ($this->enableDate) {
            $str .= '[' . date('Y-m-d') . ']';
        }
        
        $this->output[] = $str;
    }
    
    public function getOutput(): string
    {
        return implode("\n", $this->output);
    }
    
    /**
     * 可以显示消息的时间
     */
    public function enableDate()
    {
        $this->enableDate = true;
    }
    
    /**
     * 禁止显示消息的时间
     */
    public function disableDate()
    {
        $this->enableDate = false;
    }
}

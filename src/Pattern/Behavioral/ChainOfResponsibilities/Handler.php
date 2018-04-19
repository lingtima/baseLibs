<?php

namespace Tools\Pattern\Behavioral\ChainOfResponsibilities;

use Psr\Http\Message\RequestInterface;

abstract class Handler
{
    /**
     * @var null|Handler\
     * 定义继承处理器
     */
    private $successor = null;
    
    /**
     * 输入继承处理器对象
     * Handler constructor.
     * @param Handler|null $handler
     */
    public function __construct(Handler $handler = null)
    {
        $this->successor = $handler;
    }
    
    /**
     * 通过使用模板方法模式这种方法可以确保每个子类不会忽略调用继承
     *
     * @param RequestInterface $request 定义请求处理方法。
     * @return mixed
     */
    final public function handle(RequestInterface $request)
    {
        $processed = $this->processing($request);
        
        if ($processed === null) {
            
            // 请求尚未被目前的处理器处理 => 传递到下一个处理器
            if ($this->successor !== null) {
                $processed = $this->successor->handle($request);
            }
        }
        
        return $processed;
    }
    
    /**
     * 声明处理方法
     * @param RequestInterface $request
     * @return mixed
     */
    abstract protected function processing(RequestInterface $request);
}

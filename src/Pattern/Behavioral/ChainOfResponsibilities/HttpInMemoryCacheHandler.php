<?php

namespace Tools\Pattern\Behavioral\ChainOfResponsibilities;

use Psr\Http\Message\RequestInterface;

class HttpInMemoryCacheHandler extends Handler
{
    private $data;
    
    /**
     * HttpInMemoryCacheHandle constructor.
     * @param array $data 传入数据数组参数
     * @param Handler|null $successor 传入处理器对象
     */
    public function __construct(array $data, Handler $successor = null)
    {
        parent::__construct($successor);
        
        $this->data = $data;
    }
    
    /**
     * 返回缓存中对应路径存储的数据。
     * @param RequestInterface $request 传入请求类对象参数 $request 。
     * @return null
     */
    protected function processing(RequestInterface $request)
    {
        $key = sprintf('%s?%s', $request->getUri()->getPath(), $request->getUri()->getQuery());
        
        if ($request->getMethod() === 'GET' && isset($this->data[$key])) {
            return $this->data[$key];
        }
        
        return null;
    }
}

<?php

namespace Tools\Pattern\Singleton;

class Singleton
{
    /**
     * @var Singleton
     */
    private static $instance;
    
    public static function getInstance(): Singleton
    {
        if (null === self::$instance) {
            static::$instance = new static();
        }
        
        return static::$instance;
    }
    
    /**
     * 不允许从外部调用已防止创建多个实例
     * 要是用单例，必须通过 Singleton::getInstance() 方法获取实例
     */
    private function __construct()
    {
    
    }
    
    /**
     * 防止实例被克隆（这会创建实例的副本）
     */
    private function __clone()
    {
    
    }
    
    /**
     * 防止反序列化（这将创建他的副本）
     */
    private function __wakeup()
    {
    
    }
}

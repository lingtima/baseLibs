<?php

namespace Tools\Pattern\Multiton;

final class Multiton
{
    const INSTANCE_1 = '1';
    const INSTANCE_2 = '2';
    
    private static $instance = [];
    
    public static function getInstance(string $instanceName): Multiton
    {
        if (!isset(self::$instance[$instanceName])) {
            self::$instance[$instanceName] = new self();
        }
        
        return self::$instance[$instanceName];
    }
    
    /**
     * 私有方法阻止用户随意创建实例
     */
    private function __construct()
    {
    
    }
    
    /**
     * 该私有对象阻止对象被克隆
     */
    private function __clone()
    {
    
    }
    
    /**
     * 该私有方法阻止实例被序列化
     */
    private function __wakeup()
    {
    
    }
}

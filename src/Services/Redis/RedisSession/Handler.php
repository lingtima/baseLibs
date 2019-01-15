<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2018-04-03 17:38
 */

namespace Tools\Services\RedisSession;

use Tools\Services\RedisSession\Driver\IDriver;

class Handler
{
    public $driver;
    
    /**
     * @param string $type
     * @param int $expire
     * @return IDriver
     * @author lingtima@gmail.com
     */
    public static function getFactory($type, $expire = 86400)
    {
        $className = "\\Prj\\Bll\\Session\\Driver\\" . ucfirst($type);
        $Driver = new $className();
        $Driver->expire = $expire;
        
        self::init($Driver, $type);
        
        return $Driver;
    }
    
    protected static function init($Driver, $type)
    {
        switch (strtolower($type)) {
            case 'redis':
                $Driver->pre_key = 'borrower:session:';
                $Driver->writeExtendExpire = false;
                $Driver->readExtendEsxpire = false;
                break;
        }
        
        return true;
    }
}
<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2018-04-03 17:15
 */

namespace Prj\Bll\Session;

use Tools\Services\RedisSession\Handler;

class Facade
{
    protected static $instance;
    
    protected static $sessionId = 'BORROWER_SESSION';
    
    /**
     * 获取后期静态绑定实例类
     * @return static::class
     * @author lingtima@gmail.com
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    public function start($expire = 7200, $driver = 'redis')
    {
        ini_get('session.save_handler') === 'user' OR ini_set('session.save_handler', 'user');
        ini_get('session.auto_start') === 0 OR ini_set('session.auto_start', 0);
        
        if (session_status() !== PHP_SESSION_ACTIVE) {
            $handler = Handler::getFactory($driver, $expire);
            session_set_cookie_params($expire);
            session_set_save_handler(
                [$handler, 'open'],
                [$handler, 'close'],
                [$handler, 'read'],
                [$handler, 'write'],
                [$handler, 'destroy'],
                [$handler, 'gc']
            );
    
            register_shutdown_function('session_write_close');
            session_start([
                //自定义 Cookie 中 SessionId 的名称
                'name' => self::$sessionId,
//                'cookie_httponly' => true,
            ]);
        }
    
        return $this;
    }
    
    public function destroy()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
            session_commit();
            
            //手动清除 cookie 中的 session_id
            setcookie(self::$sessionId, '', time() - 36000);
            unset($_COOKIE[self::$sessionId]);
        }
        
        return true;
    }
    
    public function get($key)
    {
        return $_SESSION[$key];
    }
    
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
        return true;
    }
}
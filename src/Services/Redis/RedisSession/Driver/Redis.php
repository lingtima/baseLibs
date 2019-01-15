<?php
/**
 * 无需开启session_start
 * Author: lingtima@gmail.com
 * Time: 2018-04-03 17:13
 */

namespace Tools\Services\RedisSession\Driver;

class Redis implements IDriver
{
    public $pre_key = '';
    public $readExtendExpire = false;//读时延长有效期
    public $writeExtendExpire = false;//写时延长有效期
    
    /**
     * @var $redis DB
     */
    private $redis;
    
    public $expire = 7200;
    
    public function open()
    {
        //TODO 注入Redis驱动
//        $this->redis = parent::getDB();
        
        return true;
    }
    
    public function close()
    {
        return true;
    }
    
    public function read($sessionId)
    {
        $sessionId = $this->pre_key . $sessionId;
        $data = $this->redis->exec([['hGetAll', $sessionId]]);
        
        if ($data && $this->readExtendExpire) {
            $this->redis->exec([['setTimeout', $sessionId, $this->expire]]);
        }
        
        foreach ($data as $k => &$v) {
            //存储的是自有格式，这里需要转义后输出
            if (is_string($v) && strpos($v, 'json:>') === 0) {
                $v = json_decode(substr($v, 6), true);
            }
        }
        
        $_SESSION = $data;
    }
    
    /**
     * 这里不能直接存储到 Redis 中，需要格式化后存储
     * @param $sessionId
     * @param $data
     * @return bool
     */
    public function write($sessionId, $data)
    {
        $sessionId = $this->pre_key . $sessionId;
        $realData = $_SESSION;
        if (empty($realData)) {
            return true;
        }
        
        foreach ($realData as $k => &$v) {
            if (!is_scalar($v)) {
                $v = 'json:>' . json_encode($v);
            }
        }
        
        if (empty($this->redis->exec([['hGetAll', $sessionId]]))) {
            $this->redis->exec([['hMSet', $sessionId, $realData]]);
            $this->redis->exec([['setTimeout', $sessionId, $this->expire]]);
        } else {
            $this->redis->exec([['hMSet', $sessionId, $realData]]);
            if ($this->writeExtendExpire) {
                $this->redis->exec([['setTimeout', $sessionId, $this->expire]]);
            }
        }
        
        return true;
    }
    
    public function destroy($sessionId)
    {
        $sessionId = $this->pre_key . $sessionId;
        $this->redis->exec([['delete', $sessionId]]);
        
        return true;
    }
    
    public function gc()
    {
        return true;
    }
}
<?php
/**
 * User: lingtima@gmail.com
 * Time: 2018/10/8 16:18
 */

namespace Tools\Services;

use Illuminate\Support\Facades\Redis;
use Predis\Response\Status;

class RedisLock
{
    private $redis;


    /**
     * 请求悲观锁，为关键资源。
     * 因为没有添加死锁的检查与释放代码，所以使用更严谨的锁设置逻辑。
     * 建议将expired设置为远大于实际时间
     * 建议带入实际的value（防止错误的释放了锁）
     * @param $key
     * @param int $expired
     * @param null $value
     * @return bool
     */
    public static function getPessimisticLock($key, $expired = 60, $value = null)
    {
        if (!is_string($value)) {
            $value = time();
        }

        $flag = Redis::set($key, $value, 'EX', $expired, 'NX');
        if ($flag && $flag instanceof Status &&  $flag->getPayload() === 'OK') {
            \Log::notice('获取悲观锁成功，key:' . $key);
            return true;
        } elseif (is_null($flag)) {
            \Log::notice('获取悲观锁失败，key:' . $key);
        } else {
            \Log::notice('获取悲观锁失败，失败原因未知，key:' . $key);
        }
    }

    /**
     * 释放悲观锁-更严谨的释放悲观锁
     * @param $key
     * @param $value
     * @return bool
     */
    public static function delPessimisticLock($key, $value = null)
    {
        $actualValue = Redis::get($key);
        if (!is_null($actualValue) && !is_null($value) && $actualValue != $value) {
            \Log::notice('解铃还须系铃人，key:' . $key);
            return false;
        }

        if (is_null($actualValue)) {
            //锁已经不存在了
            \Log::notice('未找到悲观锁......key:' . $key);
            return false;
        } else {
            Redis::watch($key);
            if ($actualValue != Redis::get($key)) {
                //lock updated
                Redis::unwatch();
                \Log::notice('释放悲观锁失败，锁被其他客户端抢占了，key:' . $key);
                return false;
            } else {
                Redis::multi();
                Redis::del($key);
                $delRet = Redis::exec();
                if ($delRet && is_array($delRet) && isset($delRet[0]) && $delRet[0] === 1) {
                    \Log::notice('释放悲观锁成功，key:' . $key);
                    return true;
                } elseif (is_null($delRet)) {
                    //事务执行失败
                    Redis::unwatch();
                    \Log::notice('释放悲观锁失败，key:' . $key);
                    return false;
                } else {
                    Redis::unwatch();
                    \Log::notice('释放悲观锁失败，key:' . $key);
                    return false;
                }
            }
        }

        \Log::notice('释放悲观锁失败，原因未知，key:' . $key);
        return false;
    }
}
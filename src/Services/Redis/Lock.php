<?php
/**
 * User: lingtima@gmail.com
 * Time: 2018/10/8 16:18
 */

namespace Tools\Services\Redis;

use Predis\Client as Redis;
use Predis\Response\Status;
use Monolog\Logger;
use Carbon\Carbon;

/**
 * 分布式锁
 * @package Tools\Services\Redis
 */
class Lock
{
    const REDIS_KEY_FOR_PREV = 'test';
    const REDIS_KEY_FOR_EXPLICIT_LOCK = ':common:explicit_lock:';

    const EXPIRATION_SECONDS_FOR_LOCK = 60;

    const MESSAGE_FOR_GET_LOCK_SUCCESS           = 'success';
    const MESSAGE_FOR_GET_LOCK_ERROR             = '获取悲观锁失败';
    const MESSAGE_FOR_OTHER                      = '抱歉，未知错误';
    const MESSAGE_FOR_LOCK_MUST_OWN_INCONSISTENT = '解铃还须系铃人';

    public static function getRedisKeyForLock($applyId = 'test')
    {
        return self::REDIS_KEY_FOR_PREV . self::REDIS_KEY_FOR_EXPLICIT_LOCK . $applyId;
    }

    /**
     * 获取锁-简易
     * @param $key
     * @param null $value
     * @return bool
     */
    public static function acquireLock($key, $value = null)
    {
        if (!is_string($value)) {
            $value = time();
        }

        $flag = Redis::set($key, $value, 'EX', self::EXPIRATION_SECONDS_FOR_LOCK, 'NX');
        if ($flag && $flag instanceof Status &&  $flag->getPayload() === 'OK') {
            Logger::notice('获取悲观锁成功，key:' . $key);
            return true;
        } elseif (is_null($flag)) {
            Logger::notice('获取悲观锁失败，key:' . $key);
        } else {
            Logger::notice('获取悲观锁失败，失败原因未知，key:' . $key);
        }
    }

    /**
     * 释放悲观锁
     * @param $key
     * @param $value
     * @return bool
     */
    public static function releaseLock($key, $value = null)
    {
        $actualValue = Redis::get($key);
        if (!is_null($actualValue) && !is_null($value) && $actualValue != $value) {
            Logger::notice('解铃还须系铃人，key:' . $key);
            return false;
        }

        if (is_null($actualValue)) {
            //锁已经不存在了
            Logger::notice('未找到悲观锁......key:' . $key);
            return false;
        } else {
            Redis::watch($key);
            if ($actualValue != Redis::get($key)) {
                //lock updated
                Redis::unwatch();
                Logger::notice('释放悲观锁失败，锁被其他客户端抢占了，key:' . $key);
                return false;
            } else {
                Redis::multi();
                Redis::del($key);
                $delRet = Redis::exec();
                if ($delRet && is_array($delRet) && isset($delRet[0]) && $delRet[0] === 1) {
                    Logger::notice('释放悲观锁成功，key:' . $key);
                    return true;
                } elseif (is_null($delRet)) {
                    //事务执行失败
                    Redis::unwatch();
                    Logger::notice('释放悲观锁失败，key:' . $key);
                    return false;
                } else {
                    Redis::unwatch();
                    Logger::notice('释放悲观锁失败，key:' . $key);
                    return false;
                }
            }
        }

        Logger::notice('释放悲观锁失败，原因未知，key:' . $key);
        return false;
    }

    public static function acquireLockBetter($applyId, $value = null, $expiration = 30)
    {
        $explicitLockKey = self::getRedisKeyForLock($applyId);

        if (empty($value)) {
            $value = Carbon::now()->timestamp;
        }

        $flag = Redis::set($explicitLockKey, $value, 'EX', $expiration, 'NX');
        if ($flag && $flag instanceof Status && $flag->getPayload() === 'OK') {
            return true;
        } elseif (is_null($flag)) {
            Logger::notice(self::MESSAGE_FOR_GET_EXPLICIT_LOCK_ERROR . ':' . $applyId);
        } else {
            Logger::notice(self::MESSAGE_FOR_OTHER . ':' . $applyId);
        }

        return false;
    }

    public static function releaseLockBetter($applyId, $value = null)
    {
        $lockKey = self::getRedisKeyForLock($applyId);

        $actualValue = Redis::get($lockKey);
        if (!is_null($actualValue) && !is_null($value) && $actualValue != $value) {
            Logger::notice(self::MESSAGE_FOR_LOCK_MUST_OWN_INCONSISTENT . ':' . $applyId);
            return false;
        }

        if (is_null($actualValue)) {
            return false;
        } else {
            Redis::watch($lockKey);
            if ($actualValue != Redis::get($lockKey)) {
                Redis::unwatch();
                return false;
            } else {
                Redis::multi();
                Redis::del($lockKey);
                $delRet = Redis::exec();
                if ($delRet && is_array($delRet) && isset($delRet[0]) && $delRet[0] === 1) {
                    return true;
                } elseif (is_null($delRet)) {
                    Redis::unwatch();
                    return false;
                } else {
                    Redis::unwatch();
                    return false;
                }
            }
        }

        return false;
    }
}
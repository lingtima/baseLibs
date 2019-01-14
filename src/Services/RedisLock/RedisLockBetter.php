<?php
/**
 * User: lingtima@gmail.com
 * Time: 2019/1/14 16:31
 */

namespace Tools\Services\RedisLock;

use Carbon\Carbon;
use Monolog\Logger;
use Predis\Client as Redis;
use Predis\Response\Status;

class RedisLockBetter
{
    const REDIS_KEY_FOR_PREV = 'test';
    const REDIS_KEY_FOR_EXPLICIT_LOCK = ':common:explicit_lock:';

    const MESSAGE_FOR_GET_EXPLICIT_LOCK_ERROR = '获取悲观锁失败';
    const MESSAGE_FOR_OTHER                   = '抱歉，未知错误';
    const MESSAGE_FOR_LOCK_OWN_INCONSISTENT   = '解铃还须系铃人';

    public static function getRedisKeyForExplicitLock($applyId)
    {
        return self::REDIS_KEY_FOR_PREV . self::REDIS_KEY_FOR_EXPLICIT_LOCK . $applyId;
    }

    public static function getExplicitLock($applyId, $value = null, $expiration = 30)
    {
        $explicitLockKey = self::getRedisKeyForExplicitLock($applyId);

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

    public static function delExplicitLock($applyId, $value = null)
    {
        $explicitLockKey = self::getRedisKeyForExplicitLock($applyId);

        $actualValue = Redis::get($explicitLockKey);
        if (!is_null($actualValue) && !is_null($value) && $actualValue != $value) {
            Logger::notice(self::MESSAGE_FOR_LOCK_OWN_INCONSISTENT . ':' . $applyId);
            return false;
        }

        if (is_null($actualValue)) {
            return false;
        } else {
            Redis::watch($explicitLockKey);
            if ($actualValue != Redis::get($explicitLockKey)) {
                Redis::unwatch();
                return false;
            } else {
                Redis::multi();
                Redis::del($explicitLockKey);
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
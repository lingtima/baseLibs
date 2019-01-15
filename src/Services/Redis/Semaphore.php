<?php
/**
 * User: lingtima@gmail.com
 * Time: 2019/1/15 10:34
 */

namespace Tools\Services\Redis;

use Carbon\Carbon;
use Predis\Client as Redis;

/**
 * 计数信号量控制
 * @package Tools\Services\Redis
 */
class Semaphore
{
    const REDIS_KEY_FOR_PREV = 'test';
    const REDIS_KEY_FOR_ACCESSES_LIMIT = ':common:accesses_limit:';

    const EXPIRATION_FOR_REDIS_TYPE_STRING = 86400 * 90;//string key 的默认过期时间
    const EXPIRATION_FOR_ACCESSES_LIMIT = 60 * 5;//访问频次控制的默认过期时间

    const MAX_NUMBER_FOR_ACCESSES_LIMIT          = 20;//单位时间内最大访问次数
    const SECONDS_FOR_CHECK_GAP                  = 60;//检查访问频次的时间间隔

    public static function getRedisKeyForAccessesLimit($userId)
    {
        return self::REDIS_KEY_FOR_PREV . self::REDIS_KEY_FOR_ACCESSES_LIMIT . $userId;
    }

    /**
     * 控制访问频次
     * @param $userId
     * @throws \Exception
     */
    public static function checkAccessesLimit($userId)
    {
        $nowTimestamp = Carbon::now()->timestamp;
        $accessesLimitRedisKey = self::getRedisKeyForAccessesLimit($userId);
        $currentFrequency = Redis::llen($accessesLimitRedisKey);

        try {
            Redis::watch($accessesLimitRedisKey);
            Redis::multi();
            Redis::rpush($accessesLimitRedisKey, $nowTimestamp);
            Redis::expire($accessesLimitRedisKey, self::EXPIRATION_FOR_REDIS_TYPE_STRING);
            Redis::exec();
        } catch (\Exception $e) {
            Redis::discard();
            \Log::notice('访问频次的 Redis 事务执行失败：' . $e->getMessage());
//            UtilService::thrownErr(Code::E_COMMON_ERROR);
            throw $e;
        }

        if ($currentFrequency >= self::MAX_NUMBER_FOR_ACCESSES_LIMIT) {
            $earliestTimestamp = Redis::lpop($accessesLimitRedisKey);
            if ($nowTimestamp - $earliestTimestamp <= self::SECONDS_FOR_CHECK_GAP) {
//                UtilService::thrownErr(Code::E_VOTE_VOTING_OVER_ACCESSES_LIMIT);
                throw new \Exception('error');
            }
        }
    }
}
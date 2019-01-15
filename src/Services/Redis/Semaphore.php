<?php
/**
 * User: lingtima@gmail.com
 * Time: 2019/1/15 10:34
 */

namespace Tools\Services\Redis;

use Carbon\Carbon;
use Predis\Client as Redis;

/**
 * 计数信号量控制-通常用于限制一种资源最多能够同时被多少进程访问。如下的是对宽泛信号量的应用
 * @package Tools\Services\Redis
 */
class Semaphore
{
    const REDIS_KEY_FOR_PREV = 'test';
    const REDIS_KEY_FOR_ACCESSES_LIMIT = ':common:accesses_limit:';

    const EXPIRATION_FOR_REDIS_TYPE_STRING = 86400 * 90;//string key 的默认过期时间
    const EXPIRATION_FOR_ACCESSES_LIMIT = 60 * 5;//访问频次控制的默认过期时间
    const EXPIRATION_FOR_ACCESSES_LIMIT_OF_SIMPLE = 60 * 2;//访问频次控制的默认过期时间

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

    /**
     * 按分钟统计访问频次
     */
    public static function getAccessesLimitSimple()
    {
        $nowTimestamp = Carbon::now()->timestamp;
        $accessesLimitRedisKey = self::getRedisKeyForAccessesLimit($nowTimestamp);
        Redis::set($accessesLimitRedisKey, 0, 'EX', self::EXPIRATION_FOR_ACCESSES_LIMIT_OF_SIMPLE, 'NX');
        Redis::incr($accessesLimitRedisKey, 1);
    }

    /**
     * 每分钟访问量
     */
    public static function setAccessesLimitWithList()
    {
        $now = Carbon::now();
        $ymd = $now->format('Ymd');
        $minutes = $now->minute;

        $accessesLimitRedisKey = self::getRedisKeyForAccessesLimit($ymd);
        if (!Redis::exists($accessesLimitRedisKey)) {
            Redis::hincrby($accessesLimitRedisKey, $minutes, 1);
            Redis::expire($accessesLimitRedisKey, 86400 * 7);
        } else {
            Redis::hincrby($accessesLimitRedisKey, $minutes, 1);
        }
    }

    /**
     * 普通信号量
     */
    public static function acquireSemaphore()
    {
        $key = 'key';
        $expirationSeconds = 20;
        $identifier = uniqid();
        $timestamp = Carbon::now()->getPreciseTimestamp();
        $expirationTime = $timestamp - $expirationSeconds;
        $maxLimit = 20;

        Redis::zremrangebyscore($key, '-inf', $expirationTime);
        Redis::zadd($key, $timestamp, $identifier);

        if (Redis::zrevrank($key, $identifier) + 1 > $maxLimit) {
            //超过了最大信号量
            Redis::zrem($key, $identifier);
            return false;
        } else {
            return true;
        }
    }

    /**
     * 公平信号量（增加一个计数器、一个超时信号量集合）
     */
    public static function acquireFairSemaphore()
    {
        $counterKey = 'counter_key';
        $normalKey = 'normal_key';
        $expirationKey = 'expiration_key';

        $identifier = uniqid();
        $expirationSeconds = 20;
        $nowTimestamp = Carbon::now()->timestamp;
        $maxLimit = 20;

        Redis::zremrangebyscore($expirationKey, '-inf', $nowTimestamp - $expirationSeconds);//删除超时信号量
        Redis::zinterstore($normalKey, [$normalKey, $expirationKey], []);//取交集

        //TODO 这里自增是有上限的，需要另行处理
        $counter = Redis::incr($counterKey);//计数器自增
        Redis::zadd($normalKey, $counter, $identifier);
        Redis::zadd($expirationKey, $nowTimestamp, $identifier);

        if (Redis::zrevrank($normalKey, $identifier) + 1 > $maxLimit) {//判断是否超过了最大信号量
            //超过了最大信号量
            Redis::zrem($normalKey, $identifier);
            Redis::zrem($expirationKey, $identifier);
            return false;
        } else {
            return true;
        }


    }
}
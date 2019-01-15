<?php
/**
 * User: lingtima@gmail.com
 * Time: 2019/1/15 10:41
 */

namespace Tools\Services\Redis;

use Predis\Client as Redis;
use Predis\Response\Status;
use Monolog\Logger;
use Carbon\Carbon;

class Rank
{
    const REDIS_KEY_FOR_PREV = 'test';
    const REDIS_KEY_FOR_RANKING       = ':common:ranking:';

    public static function getRedisKeyForRanking($voteId)
    {
        return self::REDIS_KEY_FOR_PREV . self::REDIS_KEY_FOR_RANKING . $voteId;
    }

    //维护排行榜
    public static function updateRanking($voteId, $applyId, $increment = 1)
    {
        $rankingKey = self::getRedisKeyForRanking($voteId);
        return Redis::zincrby($rankingKey, $increment, $applyId);
    }

    //获取当前排名
    public static function getRankingRank($voteId, $applyId)
    {
        $rankingKey = self::getRedisKeyForRanking($voteId);
        $rank = Redis::zrevrank($rankingKey, $applyId);
        if (is_int($rank)) {
            $score = Redis::zscore($rankingKey, $applyId);
            if ($score > 0) {
                return $rank + 1;
            } else {
                return 0;
            }
        } elseif (is_null($rank)) {
            return 0;
        } else {
            return 0;
        }
    }

    //获取得分
    public static function getRankingScore($voteId, $applyId)
    {
        $rankingKey = self::getRedisKeyForRanking($voteId);
        return Redis::zscore($rankingKey, $applyId) ?? 0;
    }

    //分页获取排行榜（从高到低）
    public static function getRankingPaginate($voteId, $take, $pageId)
    {
        $rankingKey = self::getRedisKeyForRanking($voteId);
        return Redis::zrevrange($rankingKey, ($pageId - 1) * $take, $pageId * $take - 1);
    }
}
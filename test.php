<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2018-04-09 15:01
 */

function listToTree(&$result, $origin, \Closure $cbFormat = null, $cNodeName = 'children')
{
    $parentFlagName = 'id';
    $flagName = 'pid';

    $initNode = false;
    if (empty($result)) {
        $initNode = true;
    }

    foreach ($origin as $k => $v) {
        if ($v[$flagName] == ($initNode ? 0 : $result[$parentFlagName])) {
            if ($initNode) {
                $result[] = $cbFormat ? $cbFormat($v) : $v;
            } else {
                $result[$cNodeName][] = $cbFormat ? $cbFormat($v) : $v;
            }
            unset($origin[$k]);
        }
    }

    if (!empty($origin && !empty($result))) {
        foreach ($result as $k => &$v) {
            if (is_array($v)) {
                listToTree($v, $origin, $cbFormat, $cNodeName);
            }
        }
    }
}

$arr = [
    [
        'id' => 1,
        'pid' => 0,
    ],
    [
        'id' => 2,
        'pid' => 15,
    ],
    [
        'id' => 3,
        'pid' => 1,
    ],
    [
        'id' => 4,
        'pid' => 18,
    ],
    [
        'id' => 5,
        'pid' => 1,
    ],
    [
        'id' => 6,
        'pid' => 2,
    ],
    [
        'id' => 7,
        'pid' => 2,
    ],
    [
        'id' => 8,
        'pid' => 1,
    ],
    [
        'id' => 9,
        'pid' => 1,
    ],
    [
        'id' => 10,
        'pid' => 1,
    ],
    [
        'id' => 11,
        'pid' => 1,
    ],
    [
        'id' => 12,
        'pid' => 1,
    ],
    [
        'id' => 13,
        'pid' => 3,
    ],
    [
        'id' => 14,
        'pid' => 4,
    ],
    [
        'id' => 15,
        'pid' => 4,
    ],
    [
        'id' => 16,
        'pid' => 4,
    ],
    [
        'id' => 17,
        'pid' => 1,
    ],
    [
        'id' => 18,
        'pid' => 2,
    ],
    [
        'id' => 19,
        'pid' => 5,
    ],
    [
        'id' => 20,
        'pid' => 3,
    ],
    [
        'id' => 21,
        'pid' => 0,
    ],
    [
        'id' => 22,
        'pid' => 12,
    ],
    [
        'id' => 23,
        'pid' => 20,
    ],
    [
        'id' => 24,
        'pid' => 23,
    ],
    [
        'id' => 25,
        'pid' => 24,
    ],
];

$ret = [];

listToTree($ret, $arr, function ($arr) {
    return $arr;
});

var_dump($ret);
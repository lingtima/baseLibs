<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/8/27
 * Time: 9:25
 */

namespace Tools\Services;

class Common
{
    /**
     * 将无限极分类的list转化成tree
     *
     * @param array $result 保存结果数组
     * @param array $origin 原始list数组
     * @param \Closure|null $cbFormat 格式化数据
     * @param string $cNodeName 保存子节点的键
     */
    public function listToTree(&$result, $origin, \Closure $cbFormat = null, $cNodeName = 'children')
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
                    $this->listToTree($v, $origin, $cbFormat, $cNodeName);
                }
            }
        }
    }
}
<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2017-06-13 20:18
 */

namespace Tools;

class Random
{
    /**
     * 获取一个随机字符串(随机获取，保证每种模式的字符串都必须包含至少一个)
     * @param int $length 结果长度，极限情况下不得小于4，支持范围：8_20
     * @param int $pattern 设置模式：1数字，2小写字母；4大写字母；8特殊字符
     * @param string $minusStr 剔除字符
     * @param string $addStr 新加字符
     * @param bool $canRedo 结果字符是否可重复
     * @param string $specialStr 不可出现在收尾的特殊字符
     * @return mixed|string
     * @author lingtima@gmail.com
     */
    public function getString($length = 16, $pattern = 15, $minusStr = '1l0oiI ', $addStr = '', $canRedo = true, $specialStr = ' ')
    {
        $arrStrLib = [
            1 => '0123456789',
            2 => 'abcdefghijklmnopqrstuvwxyz',
            4 => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            8 => ' ~!@#$%^&*()-_=+{},.',
        ];
    
        //获取选取的字符模式-并继续处理
        $arrRet = $arrRetLib = [];
        foreach ($arrStrLib as $k => $v) {
            if (($pattern & $k) === $k) {
                $arrTmpStr = str_split($v);
            
                //与addStr去重，与minusStr去重
                $arrTmpStr = array_filter($arrTmpStr, function ($v, $k) use (&$addStr, $minusStr) {
                    $flagRet = true;
                    if (strpos($addStr, $v) !== false) {
                        $addStr = str_replace($v, '', $addStr);
                        $flagRet = false;
                    }
                
                    if (strpos($minusStr, $v) !== false) {
                        $flagRet = false;
                    }
                
                    return $flagRet;
                }, ARRAY_FILTER_USE_BOTH);
            
                //至少取一个字符
                $vPos = array_rand($arrTmpStr, 1);
                $arrRet[] = $arrTmpStr[$vPos];//[] faster than array_push
            
                if (!$canRedo) {
                    unset($arrTmpStr[$vPos]);
                }
            
                //拼接剩余总库
                $arrRetLib = array_merge($arrRetLib, $arrTmpStr);
            }
        }
    
        if (!empty($addStr)) {
            $arrAddStr = str_split($addStr);
            $tmpVPos = array_rand($arrAddStr, 1);
            $arrRet[] = $arrAddStr[$tmpVPos];
        
            if (!$canRedo) {
                unset($arrAddStr[$tmpVPos]);
            }
        
            $arrRetLib = array_merge($arrRetLib, $arrAddStr);
        }
    
        //去重
        $arrRetLib = array_unique($arrRetLib);
    
        //打乱
        shuffle($arrRetLib);
    
        //获取结果长度
        if (strpos($length, '_')) {
            list($minLen, $maxLen) = explode('_', $length);
            $length = random_int($minLen, $maxLen);
        }
        $length -= count($arrRet);
    
        //获取结果数组
        if ($canRedo) {
            $arrLen = count($arrRetLib);
            while($length > 0) {
                $vPos = random_int(0, $arrLen - 1);
                $arrRet[] = $arrRetLib[$vPos];
                $length--;
            }
        } else {
            $arrRet = array_merge($arrRet, array_intersect_key($arrRetLib, array_flip((array)array_rand($arrRetLib, $length))));
        }
    
        shuffle($arrRet);
        //保证特殊字符不出现在收尾
        if (strlen($specialStr) > 0) {
            if (strpos($specialStr, $arrRet[0]) !== false) {
                $tmp = $arrRet[0];
                $arrRet[0] = $arrRet[1];
                $arrRet[1] = $tmp;
            }
        
            $tmpLen = count($arrRet);
            if (strpos($specialStr, $arrRet[$tmpLen - 1]) !== false) {
                $tmp = $arrRet[$tmpLen - 1];
                $arrRet[$tmpLen - 1] = $arrRet[$tmpLen - 2];
                $arrRet[$tmpLen - 2] = $tmp;
            }
        }
    
        return implode('', $arrRet);
    }
    
    /**
     * 从数组中概率随机
     * @param array $array ['24_35' => 230,'36_47' => 1355,'48_59' => 3415,'60_71' => 3415,'72_83' => 1355,'84_96' => 230,]
     * @return int|mixed|string
     * @author lingtima@gmail.com
     */
    public function generateInScopeArray($array)
    {
        if (!is_array($array)) {
            return $array;
        }
        if (count($array) === 1) {
            $result = key($array);
        } else {
            $result = '';
            $arraySum = array_sum($array);
            
            //概率数组循环
            $vSum = 0;
            $randNum = random_int(1, $arraySum);
            foreach ($array as $k => $v) {
                $vSum += $v;
                if ($randNum <= $vSum) {
                    $result = $k;
                    break;
                }
            }
        }
        
        $loc = strpos($result, '_');
        if ($loc) {
            $result = random_int(substr($result, 0, $loc), substr($result, $loc + 1));
        }
        return $result;
    }
    
    /**
     * 更可靠的拆分金额算法
     * @param int $totalAmount 总金额，单位分
     * @param int $totalNum 总数量
     * @param int $minAmount 最小金额，单位分
     * @param array $result 结果数组，写入数组
     * @return array|bool 结果数组，形如[123,332,44,174,9,529]
     * @author lingtima@gmail.com
     */
    public function generateMoneyVector(int $totalAmount, int $totalNum, int $minAmount = 1, array $result = [])
    {
        /**
         * 使用递归完成最简单的红包切分
         * 优点：简单、移动、快速
         * 缺点：当可配金额越大时，红包金额可能会出现较大的差额！(即最小值出现的比较多)
         * 改进：加入波动配置，根据配置计算金额波动（在最终随机前，根据波动配置调整随机范围）
         */
        if ($totalAmount === 0 || $totalNum === 0 || ($totalAmount < $totalNum * $minAmount)) {
            return false;
        }
        
        //等额切分
        if ($totalAmount === $totalNum * $minAmount) {
            for ($i = 0; $i < $totalNum; $i++) {
                $result[] = $minAmount;
            }
            shuffle($result);
            return $result;
        }
        
        //最后一个红包
        if ($totalNum == 1) {
            array_push($result, $totalAmount);
            shuffle($result);
            return $result;
        }
        $mineAmount = random_int($minAmount, floor(($totalAmount - $totalNum * $minAmount) / 2 + $minAmount));//优化点
        $result[] = $mineAmount;
        return $this->generateMoneyVector(($totalAmount - $mineAmount), ($totalNum - 1), $minAmount, $result);
    }
}
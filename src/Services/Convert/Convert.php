<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2018-04-09 14:52
 */

namespace Tools\Services\Convert;

class Convert
{
    /**
     * 任意进制转换
     * @param string $numberInput 要转换的字符串
     * @param string $fromBaseInput @numberInput的进制格式，用字符串表示
     * @param string $toBaseInput 要输出的进制格式，用字符串表示
     * @return int|string
     * @author lingtima@gmail.com
     */
    public static function baseConvert($numberInput, $fromBaseInput = '0123456789', $toBaseInput = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        if ($fromBaseInput === $toBaseInput) {
            return $numberInput;
        }
        $fromBase = str_split($fromBaseInput, 1);
        $toBase = str_split($toBaseInput, 1);
        $number = str_split($numberInput, 1);
    
        $fromLen = strlen($fromBaseInput);
        $toLen = strlen($toBaseInput);
        $numberLen = strlen($numberInput);
    
        $retVal = '';
        if ($toBaseInput === '0123456789') {
            $retVal = 0;
            for ($i = 1; $i <= $numberLen; $i++) {
                $retVal = bcadd($retVal, bcmul(array_search($number[$i - 1], $fromBase, true), bcpow($fromLen, $numberLen - $i)));
            }
        
            return $retVal;
        }
        if ($fromBaseInput !== '0123456789') {
            $base10 = self::baseConvert($numberInput, $fromBaseInput, '0123456789');
        } else {
            $base10 = $numberInput;
        }
    
        if ($base10 < strlen($toBaseInput)) {
            return $toBase[$base10];
        }
    
        while ($base10 !== '0') {
            $retVal = $toBase[bcmod($base10, $toLen)] . $retVal;
            $base10 = bcdiv($base10, $toLen, 0);
        }
        return $retVal;
    }
}
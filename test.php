<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2018-04-09 15:01
 */

function baseConvert($numberInput, $fromBaseInput = '0123456789', $toBaseInput = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
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
        $base10 = baseConvert($numberInput, $fromBaseInput, '0123456789');
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

echo baseConvert('9999');
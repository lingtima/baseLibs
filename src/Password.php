<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2018-03-26 18:32
 */

namespace Tools;

/**
 * Class Password
 * @UnitTest tests\prj\tool\PasswordTest
 * @package Prj\Tool
 * @author lingtima@gmail.com
 */
class Password
{
    protected $minLen = 8;
    protected $maxLen = 20;
    
    protected static $rules = [
        'passwordBackend' =>  '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[~!@#\$%\^&\*\(\)_\+\-=,\.\{\} ])([a-zA-Z0-9~!@#\$%\^&\*\(\)_\+\-=,\.\{\} ]){${minLen},${maxLen}}$/',//密码:必须包含数字、小写字母、大写字母、特殊符号、长度在minLen-maxLen之间.支持的特殊字符：~!@#$%^&*()_+-=,.{}和空格
    ];
    
    public function setAttr($name, $value)
    {
        $this->$name = $value;
        return $this;
    }
    
    public function check($type, $content, $replace = [])
    {
        $replace = array_merge(['minLen' => $this->minLen, 'maxLen' => $this->maxLen], $replace);
        $rules = self::$rules[$type];
        if (!empty($replace)) {
            $rules = str_replace((function () use ($replace) {
                $tmp = [];
                array_walk($replace, function ($v, $k) use (&$tmp) {
                    $tmp[] = '${' . $k . '}';
                });
                return $tmp;
            })(), $replace, $rules);
        }
    
        $ret = (bool)preg_match($rules, $content);
//        error_log(var_export($ret, true));
        return $ret;
    }
}
<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2018-03-26 14:58
 * Desc: 构建与20180326
 */

namespace Tools;

/**
 * 大陆11位手机号
 * @package Prj\Tool
 * @author lingtima@gmail.com
 */
class Phone
{
    protected $phone;
    protected $pattern = '0';
    
    /**
     * 0 => 宽松模式
     * 1 => 严格模式
     * 2 => 超严格模式
     * @var array
     */
    protected static $patternMap = [
        "/^1\d{10}$/",
        "/^1[3456789]\d{9}$/",
        "/^13\d{9}$"
        . "|^14[014]0\d{7}$|^14[56789]\d{8}$"
        . "|^15\d{9}$"
        . "|^16[56]\d{8}$"
        . "|^17[0135678]\d{8}$|^1740[023456789]\d{6}$|^17401[012]\d{5}$"
        . "|^18\d{9}$"
        . "|^19[89]\d{8}$"
        . "/",
    ];
    
    /**
     * @var array 运营商列表
     */
    protected static $operator = [
        1 => 'Mobile',//中国移动
        2 => 'Unicom',//中国联通
        4 => 'Telecom',//中国电信
        8 => 'Virtual',//虚拟运营商
        16 => 'Unassigned',//未分配
        32 => 'InternationalEC',//工业和信息化部应急通讯保障中心，卫星移动通信业务号（用于国际应急通讯需求）
        1024 => 'Null',//未找到
    
    ];
    
    /**
     * @var array 运营商的匹配规则
     */
    protected static $phoneOperatorMap = [
        1 => "/^13[456789]\d{8}$|^1440\d{7}$|^14[78]\d{8}$|^15[012789]\d{8}$|^165\d{8}$|^178\d{8}$|^18[23478]\d{8}$|^198\d{8}$/",
        2 => "/^13[012]\d{8}$|^1400\d{7}$|^14[56]\d{8}$|^15[56]\d{8}$|^166\d{8}$|^17[156]\d{8}$|^18[56]\d{8}$/",
        4 => "/^133\d{8}$|^1410\d{7}$|^149\d{8}$|^153\d{8}$|^17[37]\d{8}$|^1740[02345]\d{6}$|^17401[3456789]\d{5}$|^18[019]\d{8}$|^199\d{8}$/",
        8 => "/^170\d{8}$/",
        16 => "/^154\d{8}$/",
        32 => "/^17401[012]\d{5}$|^1740[6789]\d{6}$/",
    ];
    
    /**
     * 设置匹配模式:0最宽松，1严格，2最严格
     * @param string $pattern 匹配模式的数字表示
     * @return $this
     * @author lingtima@gmail.com
     */
    public function setPattern(string $pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }
    
    /**
     * 设置手机号
     * @param string $phone 手机号
     * @return $this
     * @author lingtima@gmail.com
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
        return $this;
    }
    
    /**
     * 检查手机号是否合法
     * @return bool
     * @author lingtima@gmail.com
     */
    public function isPhone()
    {
        return (boolean)preg_match(self::$patternMap[$this->pattern], $this->phone);
    }
    
    /**
     * 获取手机号对应的网络运营商
     * @param bool $expectNum 期望返回数字表示
     * @return int|mixed|string
     * @author lingtima@gmail.com
     */
    public function getOperator(bool $expectNum = false)
    {
        foreach (self::$phoneOperatorMap as $k => $v) {
            if (preg_match($v, $this->phone)) {
                return $expectNum ? $k : self::$operator[$k];
            }
        }
        return $expectNum ? 1024 : self::$operator[1024];
    }
    
    /**
     * 邮政编码
     * @author lingtima@gmail.com
     */
    public function postalCode()
    {
        //TODO
    }
    
    /**
     * 区号
     * @author lingtima@gmail.com
     */
    public function areaCode()
    {
        //TODO
    }
    
    /**
     * 小灵通
     * @author lingtima@gmail.com
     */
    public function getXiaoLingTong()
    {
        //TODO
    }
    
    /**
     * 一号通
     * @author lingtima@gmail.com
     */
    public function getYiHaoTong()
    {
        //TODO
    }
}
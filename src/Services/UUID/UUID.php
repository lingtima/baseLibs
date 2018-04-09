<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2018-04-09 14:32
 */

namespace Tools\Services\UUID;
use Tools\Services\Convert\Convert;

/**
 * Class UUID
 * Universal unique identifier
 * @package Tools\Services\UUID
 * @author lingtima@gmail.com
 */
class UUID
{
    public function init()
    {
        $this->save($this->build());
    }
    
    public function get()
    {
    
    }
    
    protected function save($lib)
    {
        //TODO save
    }
    
    /**
     * 生成UUID备用库，每毫秒生成10个
     * @author lingtima@gmail.com
     */
    protected function build()
    {
        $ret = [];
        $time = time();
        for ($i = 0; $i < 10000; $i++) {
            $str = $time . sprintf('%04d', $i) . random_int(0, 99999);
            $shortStr = Convert::baseConvert($str);//缩短字符串，大概11位左右
            $ret[$shortStr] = $shortStr;
        }
        return $ret;
    }
}
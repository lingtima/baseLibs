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
    
    protected function save($lib, \Closure $callback)
    {
        if ($callback) {
            return $callback($lib);
        }
    
        //sql...
        $arr = array_chunk($lib, 100, false);
        foreach ($arr as $k => $v) {
            $sql = 'INSERT INTO `UUID` (`uuid`) VALUES ';
            $sql .= "('" . implode("'), ('", $v);
            $sql .= "');";
        }
    }
    
    /**
     * 生成UUID备用库，每毫秒生成10个，即一秒产生10000个
     * @author lingtima@gmail.com
     */
    public function build()
    {
        $ret = [];
        $time = time();
        for ($i = 0; $i < 10000; $i++) {
            $str = $time . sprintf('%04d', $i) . random_int(10000, 99999);
            $shortStr = Convert::baseConvert($str);//缩短字符串，大概11位左右
            $ret[] = $shortStr;
        }
        return $ret;
    }
}
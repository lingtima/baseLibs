<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2018-04-10 13:41
 */

namespace Tools\Tests\Services\UUID;

use Tools\Services\UUID\UUID;
use Tools\Tests\DbTestCase;

class UUIDTest extends DbTestCase
{
    public function testBuild()
    {
        $UUID = new UUID();
        $retLib = $UUID->build();
        
        $this->assertEquals(10000, count($retLib));
        
        $arr = array_chunk($retLib, 100, false);
        foreach ($arr as $k => $v) {
            $sql = 'INSERT INTO `UUID` (`uuid`) VALUES ';
            $sql .= "('" . implode("'), ('", $v);
            $sql .= "');";
            $this->getConnection()->getConnection()->query($sql);
        }
        
        
    }
}
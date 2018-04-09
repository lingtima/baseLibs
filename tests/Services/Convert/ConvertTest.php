<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2018-04-09 15:54
 */

namespace Tools\Tests\Services\Convert;

use Tools\Services\Convert\Convert;
use Tools\Tests\TestCase;

class ConvertTest extends TestCase
{
    public function testBaseConvert()
    {
        //36进制以下的转换
        for ($i = 0; $i < 10000; $i++) {
            $origin = random_int(0, 2099999999);
            
            //十进制与二进制
            $retMine = Convert::baseConvert($origin, '0123456789', '01');
            $this->assertTrue(strlen($origin) <= strlen($retMine));
            $this->assertEquals($retMine, base_convert($origin, 10, 2));
            $this->assertEquals($origin, Convert::baseConvert($retMine, '01', '0123456789'));
            
            //十进制与八进制
            $retMine = Convert::baseConvert($origin, '0123456789', '01234567');
            $this->assertTrue(strlen($origin) <= strlen($retMine));
            $this->assertEquals($retMine, base_convert($origin, 10, 8));
            $this->assertEquals($origin, Convert::baseConvert($retMine, '01234567', '0123456789'));
    
            //十进制与十六进制
            $retMine = Convert::baseConvert($origin, '0123456789', '0123456789abcdef');
            $this->assertTrue(strlen($origin) >= strlen($retMine));
            $this->assertEquals($retMine, base_convert($origin, 10, 16));
            $this->assertEquals($origin, Convert::baseConvert($retMine, '0123456789abcdef', '0123456789'));
    
            //十进制与三十六进制
            $retMine = Convert::baseConvert($origin, '0123456789', '0123456789abcdefghijklmnopqrstuvwxyz');
            $this->assertTrue(strlen($origin) >= strlen($retMine));
            $this->assertEquals($retMine, base_convert($origin, 10, 36));
            $this->assertEquals($origin, Convert::baseConvert($retMine, '0123456789abcdefghijklmnopqrstuvwxyz', '0123456789'));
            
            //大整数与二进制
            $origin = random_int(100000, 999999) . random_int(100000, 999999) . random_int(100000, 999999) . random_int(100000, 999999) . random_int(100000, 999999);
            $retMine = Convert::baseConvert($origin, '0123456789', '01');
            $this->assertTrue(strlen($origin) < strlen($retMine));
            $this->assertEquals($origin, Convert::baseConvert($retMine, '01', '0123456789'));
            
            //大整数与八进制
            $retMine = Convert::baseConvert($origin, '0123456789', '01234567');
            $this->assertTrue(strlen($origin) < strlen($retMine));
            $this->assertEquals($origin, Convert::baseConvert($retMine, '01234567', '0123456789'));
    
            //大整数与十六进制
            $retMine = Convert::baseConvert($origin, '0123456789', '0123456789abcdef');
            $this->assertTrue(strlen($origin) > strlen($retMine));
            $this->assertEquals($origin, Convert::baseConvert($retMine, '0123456789abcdef', '0123456789'));
    
            //大整数与三十六进制
            $retMine = Convert::baseConvert($origin, '0123456789', '0123456789abcdefghijklmnopqrstuvwxyz');
            $this->assertTrue(strlen($origin) > strlen($retMine));
            $this->assertEquals($origin, Convert::baseConvert($retMine, '0123456789abcdefghijklmnopqrstuvwxyz', '0123456789'));
            
            //八进制与十六进制
            $origin = base_convert(random_int(0, 2099999999), 10, 8);
            $retMine = Convert::baseConvert($origin, '01234567', '0123456789abcdef');
            $this->assertTrue(strlen($origin) >= strlen($retMine));
            $this->assertEquals($retMine, base_convert($origin, 8 , 16));
            $this->assertEquals($origin, Convert::baseConvert($retMine, '0123456789abcdef', '01234567'));
            
            //八进制与三十六进制
            $origin = base_convert(random_int(0, 2099999999), 10, 8);
            $retMine = Convert::baseConvert($origin, '01234567', '0123456789abcdefghijklmnopqrstuvwxyz');
            $this->assertTrue(strlen($origin) >= strlen($retMine));
            $this->assertEquals($retMine, base_convert($origin, 8 , 36));
            $this->assertEquals($origin, Convert::baseConvert($retMine, '0123456789abcdefghijklmnopqrstuvwxyz', '01234567'));
            
            //十六进制与三十六进制
            $origin = base_convert(random_int(0, 2099999999), 10, 16);
            $retMine = Convert::baseConvert($origin, '0123456789abcdef', '0123456789abcdefghijklmnopqrstuvwxyz');
            $this->assertTrue(strlen($origin) >= strlen($retMine));
            $this->assertEquals($retMine, base_convert($origin, 16 , 36));
            $this->assertEquals($origin, Convert::baseConvert($retMine, '0123456789abcdefghijklmnopqrstuvwxyz', '0123456789abcdef'));
            
            //随意转换
            $origin = random_int(100000, 999999) . random_int(100000, 999999) . random_int(100000, 999999) . random_int(100000, 999999) . random_int(100000, 999999);
            $retMine = Convert::baseConvert($origin);
            $this->assertTrue(strlen($origin) > strlen($retMine));
            $this->assertEquals($origin, Convert::baseConvert($retMine, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', '0123456789'));
            
            $retMine = Convert::baseConvert($origin, '0123456789', '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+/');
            $this->assertTrue(strlen($origin) > strlen($retMine));
            $this->assertEquals($origin, Convert::baseConvert($retMine, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+/', '0123456789'));
    
            $retMine = Convert::baseConvert($origin, '0123456789', 'ghijklmnopqrstuvwxPQRSTUVWXYZ+/');
            $this->assertTrue(strlen($origin) >= strlen($retMine));
            $this->assertEquals($origin, Convert::baseConvert($retMine, 'ghijklmnopqrstuvwxPQRSTUVWXYZ+/', '0123456789'));
    
            $retMine = Convert::baseConvert($origin, '0123456789', 'vwxPQRS');
            $this->assertTrue(strlen($origin) <= strlen($retMine));
            $this->assertEquals($origin, Convert::baseConvert($retMine, 'vwxPQRS', '0123456789'));
    
            $retMine = Convert::baseConvert($origin, '0123456789', '!#_@+*');
            $this->assertTrue(strlen($origin) <= strlen($retMine));
            $this->assertEquals($origin, Convert::baseConvert($retMine, '!#_@+*', '0123456789'));
        }
    }
}
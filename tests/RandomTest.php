<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2018-03-28 17:40
 */

namespace Tools\Tests;

use Tools\Tests\TestCase as BaseTestCase;
use Tools\Random;

class RandomTest extends BaseTestCase
{
    /**
     * @
     * @author lingtima@gmail.com
     */
    public function testGetString()
    {
//        $this->markTestIncomplete('complete');
        
        $Random = new Random();
        
        for ($i = 0; $i < 100; $i++) {
            //assert pattern
            $this->assertRegExp('/^\d{5,7}$/', $Random->getString('5_7', 1));
            $this->assertRegExp('/^[a-z]{14,18}$/', $Random->getString('14_18', 2));
            $this->assertRegExp('/^[A-Z]{14,18}$/', $Random->getString('14_18', 4));
            $this->assertRegExp('/^[~!@#\$%\^&\*\(\)_\+\-=,\.\{\} ]{9,11}$/', $Random->getString('9_11', 8));
            $this->assertRegExp('/^[a-z\d]{20,24}$/', $Random->getString('20_24', 3));
            $this->assertRegExp('/^[A-Z\d]{20,24}$/', $Random->getString('20_24', 5));
            $this->assertRegExp('/^[\d~!@#\$%\^&\*\(\)_\+\-=,\.\{\} ]{10,14}$/', $Random->getString('10_14', 9));
            $this->assertRegExp('/^[a-zA-Z]{28,36}$/', $Random->getString('28_36', 6));
            $this->assertRegExp('/^[a-z~!@#\$%\^&\*\(\)_\+\-=,\.\{\} ]{20,24}$/', $Random->getString('20_24', 10));
            $this->assertRegExp('/^[A-Z~!@#\$%\^&\*\(\)_\+\-=,\.\{\} ]{20,24}$/', $Random->getString('20_24', 12));
            $this->assertRegExp('/^[a-zA-Z\d]{30,45}$/', $Random->getString('30_45', 7));
            $this->assertRegExp('/^[a-z\d~!@#\$%\^&\*\(\)_\+\-=,\.\{\} ]{23,31}$/', $Random->getString('23_31', 11));
            $this->assertRegExp('/^[A-Z\d~!@#\$%\^&\*\(\)_\+\-=,\.\{\} ]{23,31}$/', $Random->getString('23_31', 13));
            
            //assert redo
            $str = $Random->getString('40_60', 15, '1l0oiI', '', false);
            $flagTrue = true;
            array_filter(str_split($str), function ($v, $k) use (&$flagTrue, $str) {
                if (strrpos($str, $v) !== $k) {
                    $flagTrue = false;
                }
                return true;
            }, ARRAY_FILTER_USE_BOTH);
            $this->assertTrue($flagTrue);
            
            //assert addStr
            $str = $Random->getString('20_35', 13, '', '');
            $this->assertRegExp('/[^a-z]+/', $str);
            $str = $Random->getString('20_35', 13, '1l0oiI', '');
            $this->assertRegExp('/[^a-z]+/', $str);
            $str = $Random->getString('20_35', 13, '', 'abcdefghijklmnopqrstuvwxyz');
            $this->assertRegExp('/[a-z]+/', $str);
            
            $str = $Random->getString('20_35', 11, '', '');
            $this->assertRegExp('/[^A-Z]+/', $str);
            $str = $Random->getString('20_35', 11, '1l0oiI', '');
            $this->assertRegExp('/[^A-Z]+/', $str);
            $str = $Random->getString('20_35', 11, '', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
            $this->assertRegExp('/[A-Z]+/', $str);
            
            $str = $Random->getString('20_35', 14, '', '');
            $this->assertRegExp('/[^\d]+/', $str);
            $str = $Random->getString('20_35', 14, '1l0oiI', '');
            $this->assertRegExp('/[^\d]+/', $str);
            $str = $Random->getString('20_35', 14, '1l0oiI', '', false);
            $this->assertRegExp('/[^\d]+/', $str);
            $str = $Random->getString('20_35', 14, '', '0123456789');
            $this->assertRegExp('/\d+/', $str);
            
            for ($j = 4; $j < 65; $j++) {
                $str = $Random->getString($j);
                //assert length
                $this->assertEquals($j, strlen($str));
                //assert contain pattern string
                $this->assertRegExp('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[~!@#\$%\^&\*\(\)_\+\-=,\.\{\} ])([a-zA-Z0-9~!@#\$%\^&\*\(\)_\+\-=,\.\{\} ]){4,64}$/', $str);
                //assert not contain string
                $this->assertRegExp('/^[^1l0oiI]+$/', $str);
                //assert not contain ordinary space from the beginning and end of a string
                $this->assertEquals($str, trim($str));
                //assert extend length
                switch (true) {
                    case $j >= 60:
                        $str = $Random->getString('60_64');
                        $this->assertTrue(strlen($str) >= 60);
                        $this->assertTrue(strlen($str) <= 64);
                        break;
                    default :
                        $str = $Random->getString("{$j}_" . ($j + 4));
                        $this->assertTrue(strlen($str) >= $j);
                        $this->assertTrue(strlen($str) <= $j + 4);
                        break;
                }
            }
        }
    }
    
    public function testGenerateInScopeArray()
    {
//        $Random = new Random();
        $this->assertTrue(True);
    }
    
    public function testGenerateMoneyVector()
    {
//        $this->markTestIncomplete('complete');
        
        $Random = new Random();
        for ($i = 0; $i < 1000; $i++) {
            $minAmount = random_int(1, 100);
            $totalNum = random_int(1, 1000);
            $totalAmount = ($minAmount + random_int(1, 50)) * $totalNum;
            
            $arrRet = $Random->generateMoneyVector($totalAmount, $totalNum, $minAmount);
            $this->assertCount($totalNum, $arrRet);
            $this->assertEquals($totalAmount, array_sum($arrRet));
            
            sort($arrRet);
            $this->assertTrue($arrRet[0] >= $minAmount);
        }
    }
}
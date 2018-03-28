<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2018-03-28 17:39
 */

namespace Tools\Tests;

use Tools\Tests\TestCase as BaseTestCase;
use Tools\Password;

class PasswordTest extends BaseTestCase
{
    public function checkProvider()
    {
        return [
            [
                'passwordBackend' => [
                    'correct' => [
                        '0zS~1111','0zS!1111','0zS@1111','0zS#1111','0zS$1111','0zS%1111','0zS^1111','0zS&1111','0zS*1111',
                        '0zS(1111','0zS)1111','0zS-1111','0zS_1111','0zS=1111','0zS+1111','0zS,1111','0zS.1111','0zS{1111',
                        '0zS}1111','0zS 1111',
                    ],
                    'wrong' => [
                        '1111111111','0000000000','aaaaaaaaaaa','AAAAAAAAAAAAA','zzzzzzzzzzzz','ZZZZZZZZZZZZZ','oooooooooooooo','OOOOOOOOOOO','~~~~~~~~~~','$$$$$$$$$$$','-----------',',,,,,,,,,,,,',
                        '000036546812','zxlckjvpiqw','LAKJVJPIQIJF',')*&@^~_*({},!',
                        'uh123l4jhl1k','12L3KNJ1KJ234','!#2398$!,.01','AKJioAJIOVqi','wei@)~,asdv,){','KJVJ!@(,(@!',
                        '012asdvVJIQ','123ioja@(,k','134VI(03JIF','jiv(JQ,Fk)',
                    ],
                ],
            ],
        ];
    }
    
    /**
     * @dataProvider checkProvider
     * @author lingtima@gmail.com
     */
    public function testCheck($passwordBackend)
    {
        $corrects = $passwordBackend['correct'];
        $wrongs = $passwordBackend['wrong'];
//        error_log(var_export($corrects, true));
        $Password = new Password();
        foreach ($corrects as $k => $v) {
            $this->assertTrue($Password->check('passwordBackend', $v));
        }
        foreach ($wrongs as $k => $v) {
            $this->assertFalse($Password->check('passwordBackend', $v));
        }
    }
}
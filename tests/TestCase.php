<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2018-03-28 17:14
 */

namespace Tools\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        error_log('=========================PHPUNIT=========================');
        parent::__construct($name, $data, $dataName);
    }
}
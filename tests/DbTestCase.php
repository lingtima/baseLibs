<?php
/**
 * Author: lingtima@gmail.com
 * Time: 2018-04-10 11:15
 */

namespace Tools\Tests;

use PHPUnit\DbUnit\Database\DefaultConnection;
use PHPUnit\DbUnit\TestCaseTrait;
use PDO;

class DbTestCase extends TestCase
{
    use TestCaseTrait;
    
    /**
     * @var PDO $pdo pdo
     */
    private static $pdo = null;
    
    /**
     * @var DefaultConnection $conn conn
     */
    private $conn = null;
    
    public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo === null) {
                $dsn = "{$GLOBALS['DB_TYPE']}:dbname={$GLOBALS['DB_NAME']};host={$GLOBALS['DB_HOST']}";
                $user = $GLOBALS['DB_USER'];
                $password = $GLOBALS['DB_PASSWORD'];
                
                $options = [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                ];
                self::$pdo = new PDO($dsn, $user, $password, $options);
            }
            
            $this->conn = $this->createDefaultDBConnection(self::$pdo, '');
            
            $this->initTable();
        }
        
        return $this->conn;
    }
    
    public function initTable()
    {
        $sql = "select * from information_schema.`TABLES` where TABLE_SCHEMA = '" . $GLOBALS['DB_NAME'] . "'";
        
        $statement = self::$pdo->prepare($sql);
        $statement->execute();
        
        if ($result = $statement->fetchAll(PDO::FETCH_ASSOC)) {
            //清空数据库
            foreach ($result as $k => $v) {
                $tmpSql = 'drop table ' . $v['TABLE_NAME'];
                self::$pdo->prepare($tmpSql)->execute();
            }
        }
        
        $initSql = file_get_contents(TEST_ROOT . '/../init.sql');
        self::$pdo->query($initSql);
    }
    
    protected function getDataSet()
    {
//        return $this->createMySQLXMLDataSet(TEST_ROOT . '/../dataSeed.xml');
        return $this->createArrayDataSet([
        
        ]);
    }
}
<?php
/**
 *  fiename: fish/PdoHelper.php$🐘
 *  date: 2024/10/18 11:46:10$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace db;
use PDO;
class PdoHelper
{
    public $host = '127.0.0.1';
    public $dbname = '';
    public $username = 'root';
    public $password = '123456';
    public $port = 3306;
    public $charset = 'utf8';
    public  $pdo;
    /*存储对象的实例*/
    private static $_instances = array();

//    public  function get_instance($configs = null)
//    {
//        if(empty(self::$instance)){
//            self::$_instances= new PdoHelper($configs);
//        }
//        return self::$_instances;
//    }
    public function __construct($configs = null)
    {
        if (is_array($configs)) {
            foreach ($configs as $option => $value) {
                $this->$option = $value;
            }
        }
        $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset};";
        $this->pdo = new \PDO($dsn, $this->username, $this->password, array(\PDO::ATTR_PERSISTENT => true));

    }

    public function count($sql){
        return $this->pdo->query($sql)->fetch(\PDO::FETCH_BOTH);
    }

    public function fetch($sql)
    {
        return   $this->pdo->query($sql)->fetch(\PDO::FETCH_ASSOC);
    }
    public function fetch_all($sql)
    {
        return $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function exec($sql)
    {
        return $this->pdo->exec($sql);
    }

    public function last_insert_id(){
        return $this->pdo->lastInsertId();
    }

    public function quote($str){
        return $this->pdo->quote($str);
    }

}


<?php
namespace library;
use PDO;
/**
 *Singletone pattern

 */
class DbConnection
{
    private static $instance = null;
    /**
     * @var PDO
     */
    private $pdo;

    private function __construct() {
        $this->pdo =new PDO("mysql:host=".Config::get('host').";dbname=".Config::get('dbname'),Config::get('user'),
            Config::get('pass'));
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); // устанавливает атрибут такой то
        // значение такоето
        $this->pdo->exec('SET NAMES utf8');

    }

    private function __clone() {}

    private function __wakeup() {}

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new DbConnection();
        }
        return self::$instance;
    }

    /**
     * @return PDO
     */
    public function getPdo(){
        return $this->pdo;
    }
}
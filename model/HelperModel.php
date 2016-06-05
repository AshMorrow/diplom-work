<?php
/**
 * Created by PhpStorm.
 * User: KoRaG
 * Date: 05.06.2016
 * Time: 20:47
 */

namespace model;
use \library\DbConnection;
use PDO;

class HelperModel
{
    public static function count($tbname){
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT COUNT(*) FROM '.$tbname);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}
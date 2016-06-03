<?php
/**
 * Created by PhpStorm.
 * User: koragg
 * Date: 01.06.16
 * Time: 20:05
 */

namespace model;


use library\DbConnection;

class RegistrationModel
{
    public function find($nick_name,$email){
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM user WHERE nick_name = :nick_name OR email = :email LIMIT 1');
        $sth->execute(compact('nick_name','email'));
        return $sth->fetch(\PDO::FETCH_ASSOC);

    }

    public function add($user_data){
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("INSERT INTO user (nick_name, birthday, email, password) values (:nick_name, :birthday, :email, :password)");
        return $sth->execute($user_data);
    }
}
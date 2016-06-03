<?php
namespace model;
use library\DbConnection;
use PDO;

class UserModel
{
    public function find($email,$password){
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM user WHERE email = :email AND password = :password LIMIT 1');
        $sth->execute(compact('email','password'));
        return $sth->fetch(PDO::FETCH_ASSOC);

    }

    public function findAll(){
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM user');
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);

    }
}
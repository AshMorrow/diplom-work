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

    public function selectById($id){
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM user WHERE id='.$id);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    public function selectByName($name){
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM user WHERE name='.$name);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function findAll(){
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM user WHERE delited = 0');
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);

    }

    public function update($id,$user_data)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("UPDATE user SET
        nick_name = :nick_name,
        birthday = :birthday,
        email = :email,
        password = :password,
        admin = :admin
        WHERE id = ". $id);
        $data = $sth->execute($user_data);
        if(!$data){
            throw new \Exception('empty array', 404);
        }
        return $data;
    }

    public function del($id)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("UPDATE user SET
        delited = 1
        WHERE id = ". $id);
        $data = $sth->execute();
        if(!$data){
            throw new \Exception('empty array', 404);
        }
        return $data;
    }

    public function add($user_data)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("INSERT INTO user (nick_name, birthday, email, password,admin) values (:nick_name, :birthday, :email, :password,:admin)");
        $data = $sth->execute($user_data);
        if(!$data){
            throw new \Exception('empty array', 404);
        }
        return $data;
    }
}
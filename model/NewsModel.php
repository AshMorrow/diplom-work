<?php
/***
 * Модель для работы с категориями новостей
 */

namespace model;

use \library\Request;
use \library\DbConnection;
use PDO;

class NewsModel
{
    public function findAllcategory($delited=null,$loged=null)
    {
        $db = DbConnection::getInstance()->getPdo();
        if($delited===0){
            $sql_part =  'WHERE delited = 0';
        }elseif($delited===1){
            $sql_part =  'WHERE delited = 1';
        }else{
            $sql_part = '';
        }

        if($loged===0){
            $sql_part_loged =  'AND loged = 0';
        }elseif($loged===1){
            $sql_part_loged =  'AND loged = 1';
        }else{
            $sql_part_loged = '';
        }
        $sth = $db->prepare('SELECT * FROM news_category '.$sql_part.' '.$sql_part_loged);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getCategoy($id,$loged=null){
        if($loged===0){
            $sql_part_loged =  'AND loged = 0';
        }elseif($loged===1){
            $sql_part_loged =  'AND loged = 1';
        }else{
            $sql_part_loged = '';
        }

        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM news_category WHERE id='.$id.' '.$sql_part_loged);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCategory($id,$category_data)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("UPDATE news_category SET
        name = :name,
        loged = :loged,
        delited = :delited
        WHERE id = ". $id);
        $data = $sth->execute($category_data);
        if(!$data){
            throw new \Exception('empty array', 404);
        }
        return $data;
    }

    public function deliteCategory($id)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("UPDATE news_category SET
        delited = 1
        WHERE id = ". $id);
        $data = $sth->execute();
        if(!$data){
            throw new \Exception('empty array', 404);
        }
        return $data;
    }

    public function addCategory($category_data)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("INSERT INTO news_category (name,loged) values (:name,:loged)");
        $data = $sth->execute($category_data);
        if(!$data){
            throw new \Exception('empty array', 404);
        }
        return $data;
    }
    public function findCategoryByName($category_name)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("SELECT id FROM news_category WHERE name='".$category_name."'");
        $data = $sth->execute();
        if(!$data){
            throw new \Exception('empty array', 404);
        }
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}


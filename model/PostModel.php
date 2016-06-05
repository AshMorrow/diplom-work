<?php
/**
 * Created by PhpStorm.
 * User: KoRaG
 * Date: 05.06.2016
 * Time: 2:52
 */

namespace model;

use \library\DbConnection;
use PDO;

class PostModel
{
    /*******************Post************************/
    public function addPost($post_data)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("INSERT INTO news_post (cat_id,post_name,post_text,tags,author_id,`date`)
    values (:cat_id,:post_name,:post_text,:tags,:author_id,:date)");
        $data = $sth->execute($post_data);
        if(!$data){
            throw new \Exception('empty array', 404);
        }
        return $data;
    }

    public function selectPostByCatId($id,$limit=5,$offset = 0){
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM news_post WHERE cat_id='.$id.' ORDER BY id DESC LIMIT '.$limit. ' OFFSET '
            .$offset );
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectPostBytId($id){
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM news_post WHERE id='.$id);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public static function countByCatIn($catid){
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT COUNT(*) as count FROM news_post WHERE cat_id='.$catid);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

}
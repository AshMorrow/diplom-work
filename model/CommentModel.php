<?php
/**
 * Created by PhpStorm.
 * User: KoRaG
 * Date: 05.06.2016
 * Time: 21:48
 */

namespace model;

use \library\DbConnection;
use PDO;

class CommentModel
{
    public function addComment($comment_data)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("INSERT INTO comment (user_id,post_id,massage)
    values (:user_id,:post_id,:massage)");
        $data = $sth->execute($comment_data);
        if(!$data){
            throw new \Exception('empty array', 404);
        }
        return $data;
    }

    public function updateComment($id,$comment_data)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("UPDATE comment SET
        massage = :massage,
        confirm = :confirm,
        delited = :delited
        WHERE id = ". $id);
        $data = $sth->execute($comment_data);
        if(!$data){
            throw new \Exception('empty array', 404);
        }
        return $data;
    }

    public function deliteComment($id)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("UPDATE comment SET
        delited = 1
        WHERE id = ". $id);
        $data = $sth->execute();
        if(!$data){
            throw new \Exception('empty array', 404);
        }
        return $data;
    }

    public function selectCommentBytId($id){
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM comment WHERE id='.$id);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }


    public function getComment($post_id=null)
    {
        if($post_id){
            $sql_part = ' WHERE post_id='.$post_id;
        }
        else{
            $sql_part = '';
        }
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("SELECT * FROM comment".$sql_part);
        $data = $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

}
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

    public function getComment($post_id)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("SELECT * FROM comment WHERE post_id=".$post_id);
        $data = $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

}
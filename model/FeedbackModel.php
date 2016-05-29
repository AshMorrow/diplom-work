<?php
namespace model;
use library\DbConnection;

class FeedbackModel{
    public function save(array $massage){
        //TODO: проверить что бы в массиве $masage бфли ключи как поля в таблице

        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('INSERT INTO feedback VALUES (:id,:username,:email,:massage,:created,:ip)');
        $sth->execute($massage);
    }
}
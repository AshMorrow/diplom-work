<?php
/**
 * Created by PhpStorm.
 * User: koragg
 * Date: 02.06.16
 * Time: 16:57
 */

namespace model;
use \library\DbConnection;
use PDO;

class SearchModel
{
    public function UserPokemonSearch($type){
        if(is_numeric($type)){
            $searhc_part = 'id='.$type;
        }elseif (is_string($type)){
            $searhc_part = 'name LIKE \'%'.$type.'%\'';
        }else{
            throw new \Exception('Неверный параметр в модели',404);
        }
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM pokemon WHERE '.$searhc_part);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function PokemonSearchParam($type){
        if(isset($type['type'])){
            $searhc_part = 'type LIKE \'%'.$type['type'].'%\'';
        }elseif (isset($type['weaknes'])){
            $searhc_part = 'weaknesses LIKE \'%'.$type['weaknes'].'%\'';
        }else{
            throw new \Exception('Неверный параметр в модели',404);
        }
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM pokemon WHERE '.$searhc_part);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}
<?php
namespace model;
use \library\DbConnection;
use \PDO;
use \Exception;

class PokedexModel
{
    public function findAll($offset=0,$limit=10)
    {

        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->query('SELECT * FROM pokemon ORDER BY id LIMIT '. $limit .' OFFSET '.$offset);
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        if (!$data) {
            throw new Exception('empty array', 404);
        }

        $pokemon_data = $data;
        return $pokemon_data;
    }

    public function getPokemon($name){
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM pokemon WHERE name = ?');
        $sth->bindParam(1,$name);
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        if (!$data) {
            throw new Exception('empty array', 404);
        }
        $pokemon_data = $data;
        return $pokemon_data;
    }
}
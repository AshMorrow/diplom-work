<?php
/**
 * Created by PhpStorm.
 * User: koragg
 * Date: 02.06.16
 * Time: 19:26
 */

namespace model;
use library\DbConnection;

class PokemonModel
{
    public function update($id,$pokemon_data){
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("UPDATE pokemon SET
        `name` = :name,
        pokemon_id = :pokemon_id,
        descriptionX = :descriptionX,
        descriptionY = :descriptionY,
        weaknesses = :weaknesses,
        `type` = :type,
        evolutions = :evolutions,
        hp = :hp,
        attack = :attack,
        defense = :defense,
        special_attack = :special_attack,
        special_defense = :special_defense,
        speed = :speed,
        height = :height,
        weight = :weight,
        gender = :gender,
        category = :category,
        abilities = :abilities
        WHERE id = ". $id);
        return $sth->execute($pokemon_data);
    }

}
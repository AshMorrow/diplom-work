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
        var_dump($pokemon_data);
        die;
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("UPDATE user(
            `name`,pokemon_id,descriptionX,descriptionY,weaknesses,`type`,evolutions,hp,attack,defense,special_attack,special_defense,speed,
            height,weight,gender,category,abilities) 
            SET values (
            :name,:pokemon_id,:descriptionX,:descriptionY,:weaknesses,:type,:evolutions,:hp,:attack,:defense,:special_attack,:special_defense,:speed,
            :height,:weight,:gender,:category,:abilities) WHERE id = ".$id);
        return $sth->execute($pokemon_data);
    }

}
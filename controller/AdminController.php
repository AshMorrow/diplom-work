<?php
use library\Request;
class AdminController extends \library\Controller
{
    public function pokemonselectAction(Request $request){
        $model = new \model\PokedexModel();
        $request->get('offset')? $offset = $request->get('offset'):$offset = 0;
        $pokemon_data = $model->findAll($offset);
        return $this->render('pokemonlist',$pokemon_data);
        
    }

    public function pokemoneditAction(Request $request){
        $model = new \model\PokedexModel();
        $pokemon_data = $model->getPokemon($request->get('name'));
        return $this->render('pokemon',$pokemon_data);
    }
}
<?php
use library\Request;

class AdminController extends \library\Controller
{
    public function pokemonselectAction(Request $request)
    {
        $model = new \model\PokedexModel();
        $request->get('offset') ? $offset = $request->get('offset') : $offset = 0;
        $pokemon_data = $model->findAll($offset);
        return $this->render('pokemonlist', $pokemon_data);

    }

    public function pokemoneditAction(Request $request)
    {
        $model = new \model\PokedexModel();
        $pokemon_data = $model->getPokemon($request->get('name'));
        if ($request->isPost()) {
            $this->pokemonupdateAction($request);
        }
        return $this->render('pokemon', $pokemon_data);
    }

    public function pokemonupdateAction(Request $request)
    {
        $form = new \model\PokemonForm($request);
        if ($request->isPost()) {
            $model = new \model\PokemonModel();
            $user_data = [
                'id' => $request->post('id'),
                'name' => $request->post('name'),
                'pokemon_id' => $request->post('pokemon_id'),
                'descriptionX' => $request->post('descriptionX'),
                'descriptionY' => $request->post('descriptionY'),
                'weaknesses' => $request->post('weaknesses'),
                'type' => $request->post('type'),
                'evolutions' => $request->post('evolutions'),
                'hp' => $request->post('hp'),
                'attack' => $request->post('attack'),
                'defense' => $request->post('defense'),
                'special_attack' => $request->post('special_attack'),
                'special_defense' => $request->post('special_defense'),
                'speed' => $request->post('speed'),
                'height' => $request->post('height'),
                'weight' => $request->post('weight'),
                'gender' => $request->post('gender'),
                'category' => $request->post('category'),
                'abilities' => $request->post('abilities')
            ];
            if($model->update($user_data)){
                \library\Session::setFlash('Сохранено');
                \library\Router::redirect('/index.php?route=index/contact');
            }else{
                \library\Session::setFlash('что то нетак');
            }
        }

    }
}
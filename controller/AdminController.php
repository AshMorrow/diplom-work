<?php
use library\Request;

class AdminController extends \library\Controller
{
    public function pokemonselectAction(Request $request)
    {
        $model = new \model\PokedexModel();
        $count = $model->_count('pokemon');
        $request->get('offset') ? $offset = $request->get('offset') : $offset = 0;
        $pokemon_data = $model->findAll($offset);
        $pokemon_data['count'] = $count['count'];
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

    public function usereditAction(Request $request)
    {
        $model = new \model\UserModel();
        $user_data = $model->getPokemon($request->get('name'));
        if ($request->isPost()) {
            $this->pokemonupdateAction($request);
        }
        return $this->render('useredit', $user_data);
    }

    public function userlistAction(){
        $model = new \model\UserModel();
        $user_data = $model->findAll();
        return $this->render('userlist', $user_data);
    }

    public function pokemonupdateAction(Request $request)
    {
        $form = new \model\PokemonForm($request);
        if ($request->isPost()) {
            $model = new \model\PokemonModel();
            $id = $request->post('id');
            $pokemon_data = [
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
            if($model->update($id,$pokemon_data)){
                \library\Session::setFlash('Сохранено');
                \library\Router::redirect($_SERVER['REQUEST_URI']);
            }else{
                \library\Session::setFlash('что то нетак');
            }
        }

    }
}
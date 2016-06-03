<?php
use \library\Controller;
use \library\Request;
use \library\Session;
use \library\Router;
use \model\PageModel;
use \model\ContactForm;
use \model\FeedbackModel;

class IndexController extends Controller
{
    public function indexAction(Request $request,array $param = []){

        $model = new PageModel();
        $page = $model->findByAllias('homepage');
        $param = array(
            'page' => $page
        );
       return $this->render('index',$param);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     * Гравная стрница
     */
    public function pokedexAction(Request $request){
        $model = new \model\PokedexModel();
        $pokemon_data = $model->findAll();
        return $this->render('pokedex',$pokemon_data);
    }

    /**
     * @param Request $request
     * @return string
     * @throws Exception
     * Страница с поиском
     */
    public function searchAction(Request $request){
        $model = new \model\SearchModel();
        $pokemon_data = $model->UserPokemonSearch($request->get('search'));
        return $this->render('search',$pokemon_data);
    }

    public function searchbytypeAction(Request $request){
        $model = new \model\SearchModel();
        $type = $request->get('type');
        $weaknes = $request->get('weaknes');
        if($type){
            $pokemon_data['type'] = $type;
        }
        if($weaknes){
            $pokemon_data['weaknes'] = $weaknes;
        }
        $pokemon_data = $model->PokemonSearchParam($pokemon_data);

        return $this->render('search',$pokemon_data);
    }

    /**
     * @param Request $request
     * @return string
     * @throws Exception
     * Данные для ajax подгрузки
     */
    public function unitAction(Request $request){
        $offset = $request->get('offset');
        $model = new \model\PokedexModel();
        $pokemon_data = $model->findAll($offset);
        return $this->renderUnit('pokedexUnit',$pokemon_data);
    }


    public function pokemonAction(Request $request){
        $model = new \model\PokedexModel();
        $pokemon_data = $model->getPokemon($request->get('name'));
        return $this->render('pokemon',$pokemon_data);
    }


}
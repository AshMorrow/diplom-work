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

    public function searchAction(Request $request){
        $model = new \model\SearchModel();
        $pokemon_data = $model->UserPokemonSearch($request->get('search'));
        return $this->render('search',$pokemon_data);
    }
    
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
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

    public function pokedexAction(Request $request){
        $model = new \model\PokedexModel();
        $pokemon_data = $model->findAll();
        return $this->render('pokedex',$pokemon_data);
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

    public function contactAction(Request $request){
        $form = new ContactForm($request);
        $datetime = new \DateTime();
        if ($request->isPost()){ // была ли отправлена форма
            if($form->isValid()){
                
                
                (new FeedbackModel())->save([
                   'id' => null,
                    'username' => $form->username,
                    'email' => $form->email,
                    'massage' => $form->massage,
                    'created' => $datetime->format('Y-m-d H:i:s'),
                    'ip' => $request->getIpAddres()
                ]);
                Session::setFlash('Massage sent');
                Router::redirect('/index.php?route=index/contact');
            }
            Session::setFlash('Field the field');
        }

        // Вернет масси с указаными ключами значения который возьмет из одноименных
        // переменных
        $args = compact('form');
        return $this->render('contact',$args);
    }


}
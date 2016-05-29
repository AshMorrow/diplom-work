<?php
use \library\Controller;
use \library\Request;
use \library\Session;
use \library\Router;
use \library\Password;
use \model\LoginForm;
use \model\UserModel;

/**
 * Created by PhpStorm.
 * User: KoRaG
 * Date: 05.05.2016
 * Time: 21:39
 */
class SecurityController extends Controller // В контролере находится рендер
{
    public function loginAction(Request $request){
        $form = new LoginForm($request);
        if($request->isPost()){
            if($form->isValid()){
                $model = new UserModel();
                $password = new Password($form->password);
                $email = $form->email;
                if($model->find($email,$password)){
                    Session::set('user',$email);
                    //Session::setFlash('Signed in');
                    Router::redirect('/index.php?route=security/admin');
                }

                Session::setFlash('User not Found');
                //Router::redirect('/index.php?route=security/login');

            }

            Session::setFlash('You idiot');
        }
        return $this->render('index',compact($form));

    }

    public function adminAction(Request $request){
        return $this->render('admin');
    }
}

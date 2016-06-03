<?php
use \library\Controller;
use \library\Request;
use \library\Session;
use \library\Router;
use \library\Password;
use \model\LoginForm;
use \model\UserModel;

class SecurityController extends Controller
{
    public function loginAction(Request $request){
        $form = new LoginForm($request);
        if($request->isPost()){
            if($form->isValid()){
                $model = new UserModel();
                $password = new Password($form->password);
                $email = $form->email;
                $user = $model->find($email,$password);
                if($user){
                    Session::set('user',$email);
                    Session::set('loged',true);
                    Session::set('admin',(bool)$user['admin']);
                    Router::redirect('/index.php?route=user/welcome');
                }

                Session::setFlash('User not Found');
            }

            Session::setFlash('You idiot');
        }
        return $this->render('index',compact($form));

    }
    
    public function registrationAction(Request $request){
        $form = new \model\RegistrationForm($request);
        if($request->isPost() && $form->is_valid()){
            $model = new \model\RegistrationModel();
            $password = new Password($form->password);
            $email = $form->email;
            if(!$model->find($form->nick_name,$email)){
                $user_data = [
                    'nick_name' => $form->nick_name,
                    'birthday' => $form->birthday,
                    'email' => $email,
                    'password' => (string)$password
                ];
                if($model->add($user_data)){
                    Session::setFlash('registered');
                    Session::set('user',$form->nick_name);
                    Session::set('admin',false);
                    Session::set('loged',true);
                    Router::redirect('/');
                }
            }

        }
        return $this->render('registration',compact($form));
        
    }

    public function adminAction(Request $request){
        return $this->render('admin');
    }

    public function logoutAction(){
        Session::destroy();
        Router::redirect('/');
    }
}

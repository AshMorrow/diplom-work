<?php

/**
 * Created by PhpStorm.
 * User: koragg
 * Date: 02.06.16
 * Time: 0:15
 */
class UserController extends \library\Controller
{
    public function welcomeAction(\library\Request $request){
        return $this->render('user');
    }

}
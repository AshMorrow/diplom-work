<?php

use \library\Controller;
use \library\Router;
use \library\Request;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT',dirname( __DIR__) . DS);
define('VIEW_DIR', ROOT . 'view' . DS);
define('LIB_DIR', ROOT . 'library' . DS);
define('CONTROLLER_DIR', ROOT . 'controller' . DS);
define('MODEL_DIR', ROOT . 'model' . DS);
define('CONF_DIR', ROOT . 'config' . DS);

function __autoload($c_name){
    $file = "{$c_name}.php";
    if(file_exists(ROOT.$file)){
       require ROOT.$file;
    }elseif(file_exists(CONTROLLER_DIR.$file))
    {
        require CONTROLLER_DIR.$file;
    }
    else {
        throw new Exception("{$file} not found",404);
    }
}
try {
   // ob_start(); // непонимаю почепу при отправке админ формы неудается сделать редирект

    \library\Session::start();
    \library\Config::setFromXML('db.xml');

    $request = new Request();
    $route = $request->get('route');
    if (is_null($route)) {
        $route = "index/pokedex";
    }

    $route = explode('/', $route);
    $controller = ucfirst(strtolower($route[0])) . 'Controller';  //Like book =>> BookController
    $action = $route[1] . 'Action';
    $controller = new $controller();

    if (!method_exists($controller, $action)) {
        throw new Exception("{$action} not found");
    }
   $content = $controller->$action($request);
}catch(Exception $e){
    $content = Controller::renderError($e->getCode(),$e->getMessage());
}

echo $content;

//
//echo "<hr>";
////require VIEW_DIR . 'default_layout.phtml';
//var_dump($route,$controller,$action);
//var_dump($_SERVER['REQUEST_URI']);

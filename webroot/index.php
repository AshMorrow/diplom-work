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
    $file = str_ireplace('\\',DS,$file); //Как я мог забыть про linux....
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
    \library\Session::start();
    \library\Config::setFromXML('db.xml');

    $request = new Request();
    $route = $request->get('route');
    if($request->get('search')){
        $route = "index/search";

    }elseif (is_null($route)) {
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


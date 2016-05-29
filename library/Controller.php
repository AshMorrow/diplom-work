<?php
namespace library;

abstract class Controller
{
    protected function render($view_name,$param = []){
        if(count($param) >0) {
            extract($param);
        }
        $tpl_dir = str_ireplace('Controller','',get_class($this));
        $file = VIEW_DIR.$tpl_dir.DS.$view_name.'.phtml';
        if(!file_exists($file)){
            throw new \Exception($file.' not found');
        }
        ob_start();
        require $file;
        $content = ob_get_clean();

        ob_start();
        require  VIEW_DIR.'default_layout.phtml';
        return ob_get_clean();
    }
    
    protected function renderUnit($view_name,$param = []){
        ob_start();
        $tpl_dir = str_ireplace('Controller','',get_class($this));
        require VIEW_DIR.$tpl_dir.DS.$view_name.'.phtml';
        return ob_get_clean();
    }

    public static function renderError($code,$massage){
        ob_start();
        require_once VIEW_DIR.'error.phtml';
        return ob_get_clean();
    }
}
<?php
namespace library;
/**
 * Created by PhpStorm.
 * User: koragg
 * Date: 22.04.16
 * Time: 20:51
 */
abstract class Router
{
    public static function redirect($uri){
        header("Location: {$uri}");
        die;
    }
}
<?php
namespace library;

abstract class MetaHelper
{
    /**
     * Генерация присваевание тайтлов
     */

    private static $title = 'Pokedex';
    const SEPARATOR = ' - ';
    public static function getTitle(){

        return self::$title;
    }

    public static function addTitle($title){
        self::$title.=self::SEPARATOR.$title;
    }

    public static function setTitle($title){
        self::$title = $title;
    }

}
<?php
namespace library;

abstract class Config
{
    /**
     * @var array
     * Массив с настройками
     * regestry
     */
    private static $element = array();

    public static function set($key,$vales){

        self::$element[$key] = $vales;
    }

    public static function get($key){

        if(isset(self::$element[$key])){
            return self::$element[$key];
        }

        return null;
    }

    /**
     * @param $file
     * разберает xml файл конфиг копипаст с php.net
     */
    public static function setFromXML($file)
    {
        $xmlObject = simplexml_load_file(CONF_DIR . $file, 'SimpleXMLElement', LIBXML_NOWARNING);

        if (!$xmlObject) {
            return;
        }

        $newArray = array() ;
        $array = (array)$xmlObject ;

        foreach ($array as $key => $value)  {
            $value = (array) $value ;

            $newArray [$key] = isset($value [0]) ? $value[0] : '' ;
        }

        $newArray = array_map("trim", $newArray);

        self::$element = array_merge(self::$element, $newArray);
    }
}
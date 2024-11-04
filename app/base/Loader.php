<?php

/**
 *  fiename: fish/Loader.php$
 *  date: 2024/10/17 21:16:31$
 *  author: hepm<ok_fish@qq.com>$
 */
namespace app\base;
class Loader
{
    static function autoload($class){
        $class_path = WEB_PATH.'/../'.str_replace('\\','/',$class).'.php';
        if(file_exists($class_path)){
            include_once $class_path;
        }
    }
}
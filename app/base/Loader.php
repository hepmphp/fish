<?php

/**
 *  fiename: fish/Loader.php$
 *  date: 2024/10/17 21:16:31$
 *  author: hepm<ok_fish@qq.com>$
 */
namespace base;
class Loader
{
    static function autoload($class){
        $class_path = APP_PATH.'./'.str_replace('\\','/',$class).'.php';
        include_once $class_path;
    }
}
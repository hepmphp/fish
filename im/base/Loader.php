<?php

/**
 *  fiename: fish/Loader.php$
 *  date: 2024/10/17 21:16:31$
 *  author: hepm<ok_fish@qq.com>$
 */
namespace im\base;
class Loader
{
    static function autoload($class){
        //$class = str_replace('cms','',$class);
        $class_path = WEB_PATH.'/../'.str_replace('\\','/',$class).'.php';
//        var_dump(__FILE__.__LINE__.$class,$class_path);
        if(file_exists($class_path)){
            include_once $class_path;
        }else{
            $class_path = APP_PATH.'./'.str_replace('\\','/',$class).'.php';
//            var_dump(__FILE__.__LINE__.$class,$class_path);
            if(file_exists($class_path)){
                include_once $class_path;
            }
        }

    }
}
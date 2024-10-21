<?php
/**
 *  fiename: fish/index.php$🐘
 *  date: 2024/10/17 20:32:34$
 *  author: hepm<ok_fish@qq.com>$
 */
define('DEBUG',TRUE);
define('WEB_PATH',__DIR__);
define('STATIC_URL','http://127.0.0.1:2222/static');
define('APP_PATH',WEB_PATH.'/../app/');
include APP_PATH.'/base/Loader.php';
spl_autoload_register("\\base\Loader::autoload");//自有类库自动载入
include WEB_PATH.'/../vendor/autoload.php';
//if(DEBUG){
//    if(!\helpers\Input::is_post() OR \helpers\Input::is_ajax()){
//        \helpers\Timer::go('app');
//    }
//}
$app= \base\App::get_instance(APP_PATH);
$app->run();
//echo "<pre>";
//var_dump($app->config['const']);






<?php
/**
 *  fiename: fish/index.php$🐘
 *  date: 2024/10/17 20:32:34$
 *  author: hepm<ok_fish@qq.com>$
 */
use doc\base\DocApp;

define('DEBUG',TRUE);
define('SITE_URL','http://127.0.0.1/doc.php');
define('WEB_PATH',__DIR__);
define('STATIC_URL','http://127.0.0.1/static/doc/');
define('APP_PATH',WEB_PATH.'/../app/');
define('DOC_PATH',WEB_PATH.'/../doc/');

include DOC_PATH.'/base/Loader.php';
spl_autoload_register("\\doc\base\Loader::autoload");//自有类库自动载入

//if(DEBUG){
//    \app\helpers\Timer::go('app');
//}


$app= DocApp::get_instance(DOC_PATH);
$app->run();

//echo "<pre>";
//var_dump($app->config['const']);


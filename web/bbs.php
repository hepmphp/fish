<?php
/**
 *  fiename: fish/index.php$🐘
 *  date: 2024/10/17 20:32:34$
 *  author: hepm<ok_fish@qq.com>$
 */
use bbs\base\BbsApp;
define('DEBUG',TRUE);
define('SITE_URL','http://127.0.0.1:2222/bbs.php');
define('WEB_PATH',__DIR__);
define('STATIC_URL','http://127.0.0.1:2222/static/bbs/');
define('APP_PATH',WEB_PATH.'/../app/');
define('BBS_PATH',WEB_PATH.'/../bbs/');
include BBS_PATH.'/base/Loader.php';
spl_autoload_register("\\bbs\base\Loader::autoload");//自有类库自动载入

//if(DEBUG){
//    \app\helpers\Timer::go('app');
//}

$app= BbsApp::get_instance(BBS_PATH);
$app->run();

//echo "<pre>";
//var_dump($app->config['const']);


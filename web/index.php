<?php
/**
 *  fiename: fish/index.php$🐘
 *  date: 2024/10/17 20:32:34$
 *  author: hepm<ok_fish@qq.com>$
 */

error_reporting(E_ALL);
ini_set('display_errors','On');
ini_set('log_errors','On');
define('DEBUG',TRUE);
define('WEB_PATH',__DIR__);
define('APP_PATH',WEB_PATH.'/../app/');
include APP_PATH.'/base/Loader.php';
spl_autoload_register("\\base\Loader::autoload");//自有类库自动载入
include WEB_PATH.'/../vendor/autoload.php';

//\helpers\Timer::go('app');

//throw new \Exception('HAHA');

$app= \base\App::get_instance(APP_PATH);
$app->run();
//echo "<pre>";
//var_dump($app->config['const']);






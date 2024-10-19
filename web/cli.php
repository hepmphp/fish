<?php
/**
 *  fiename: fish/cli.php$🐘
 *  date: 2024/10/18 16:44:41$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

define('DEBUG',TRUE);
define('WEB_PATH',__DIR__);
define('APP_PATH',WEB_PATH.'/../app/');
include APP_PATH.'/base/Loader.php';
spl_autoload_register("\\base\Loader::autoload");//自有类库自动载入
include WEB_PATH.'/../vendor/autoload.php';
if(!is_array($argv)){
    throw new Exception('error params');
}

$_SERVER['PATH_INFO'] = $argv[1];
$_SERVER['REQUEST_URI'] = $argv[1];
$app= \base\App::get_instance(APP_PATH);
$app->run();
/*
 *    用法
 *    php -f cli.php  fish/welcome/index
 *
 */
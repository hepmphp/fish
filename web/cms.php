<?php
/**
 *  fiename: fish/index.php$🐘
 *  date: 2024/10/17 20:32:34$
 *  author: hepm<ok_fish@qq.com>$
 */
use cms\base\CmsApp;
define('DEBUG',TRUE);
define('SITE_URL','http://127.0.0.1:2222/cms.php');
define('WEB_PATH',__DIR__);
define('STATIC_URL','http://127.0.0.1:2222/static/cms/');
define('APP_PATH',WEB_PATH.'/../app/');
define('CMS_PATH',WEB_PATH.'/../cms/');
include CMS_PATH.'/base/Loader.php';
spl_autoload_register("\\cms\base\Loader::autoload");//自有类库自动载入

if(DEBUG){
    \helpers\Timer::go('app');
}

$app= CmsApp::get_instance(CMS_PATH);
$app->run();
//echo "<pre>";
//var_dump($app->config['const']);


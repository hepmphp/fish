<?php
/**
 *  fiename: fish/session.php$🐘
 *  date: 2024/10/18 15:31:13$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */




//sessoin配置
$config['session'] = array(
    'SESSION_AUTO_START' => true,
    'SESSION_OPTIONS' => array(
        //'id'=>'fish',
        //'name'=>'fish',
        'path'=>WEB_PATH.'/log/cache/',
        #::todo 配置session redis
        //'path'=>'127.0.0.1:6379',
        'expire' => '3600',//过期时间
//        'domian'=>'',//单点登录共享同一个域名时候设置
    ),
    'SESSION_TYPE' => 'File',
//    'SESSION_TYPE' => 'Redis',
    'SESSION_PREFIX' => 'fish_',
//    'VAR_SESSION_ID'=>'',
);

//reids配置
$config['redis'] = array(
    'host' => '127.0.0.1',
    'port' => 6379,
    'timeout' => 10,
    'persistent' => false,
    'expire' => 0,
    'length' => 0,

);


return $config;

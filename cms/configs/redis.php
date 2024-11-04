<?php
/**
 *  fiename: fish/redis.php$🐘
 *  date:  2024/11/4   12:52$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
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
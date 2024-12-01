<?php
/**
 *  fiename: fish/database.php$
 *  date: 2024/10/17 22:33:16$
 *  author: hepm<ok_fish@qq.com>$
 */
$config['master'] = [
    'host' => '127.0.0.1',
    'dbname' => 'fish_admin',
    'username' => 'root',
    'password' => '123456',
    'port' => 3306,
    'charset' => 'utf8',
];
$config['cms'] = [
    'host' => '127.0.0.1',
    'dbname' => 'fish_cms',
    'username' => 'root',
    'password' => '123456',
    'port' => 3306,
    'charset' => 'utf8',
];
$config['bbs'] = [
    'host' => '127.0.0.1',
    'dbname' => 'fish_bbs',
    'username' => 'root',
    'password' => '123456',
    'port' => 3306,
    'charset' => 'utf8',
];
$config['doc'] = [
    'host' => '127.0.0.1',
    'dbname' => 'fish_doc',
    'username' => 'root',
    'password' => '123456',
    'port' => 3306,
    'charset' => 'utf8',
];

return $config;
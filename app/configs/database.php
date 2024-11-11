<?php
/**
 *  fiename: fish/database.php$
 *  date: 2024/10/17 22:33:16$
 *  author: hepm<ok_fish@qq.com>$
 */
$config['master'] = [
    'host' => 'mysql',
    'dbname' => 'fish_admin',
    'username' => 'root',
    'password' => '123456',
    'port' => 3306,
    'charset' => 'utf8',
];
$config['cms'] = [
    'host' => 'mysql',
    'dbname' => 'fish_cms',
    'username' => 'root',
    'password' => '123456',
    'port' => 3306,
    'charset' => 'utf8',
];
$config['bbs'] = [
    'host' => 'mysql',
    'dbname' => 'fish_bbs',
    'username' => 'root',
    'password' => '123456',
    'port' => 3306,
    'charset' => 'utf8',
];

$config['im'] = [
    'host' => 'mysql',
    'dbname' => 'fish_im',
    'username' => 'root',
    'password' => '123456',
    'port' => 3306,
    'charset' => 'utf8',
];

return $config;
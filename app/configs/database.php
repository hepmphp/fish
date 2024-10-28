<?php
/**
 *  fiename: fish/database.php$
 *  date: 2024/10/17 22:33:16$
 *  author: hepm<ok_fish@qq.com>$
 */
$config['master'] = [
    'host' => '127.0.0.1',
    'dbname' => 'game_admin',
    'username' => 'root',
    'password' => '123456',
    'port' => 3306,
    'charset' => 'utf8',
];
$config['slave'] = [
    'host' => '127.0.0.1',
    'dbname' => 'phpbb',
    'username' => 'root',
    'password' => '',
    'port' => 3306,
    'charset' => 'utf8',
];


return $config;
<?php

/****身份验证****/
$config = array(
    'testing' => array(
        'host'     => '127.0.0.1',
        'port'     => 6379,
        'database' => 0,
    ),
    'default' => array(
        'host'     => '127.0.0.1',
        'port'     => 6379,
        'database' => 0,
    ),
);

$script_name =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$server      =  isset( $_GET["server"] )  ? $_GET["server"]   : 'default';
$db          =  isset( $_GET["db"] )      ? $_GET["db"]       : 0;
$action      =  isset( $_GET["action"] )  ? $_GET['action']   : 'list';
$pattern     =  isset( $_GET['pattern'] ) ? $_GET['pattern']  : '*';
$Redis = new Redis();
$Redis->connect($config[$server]['host'], $config[$server]['port'], 5);

try {
    $Redis->ping();
} catch( Exception $e ) {
    die("Couldn't connect to server [tcp://{$config[$server]['host']}:{$config[$server]['port']}]. " . $e->getMessage());
}
$Redis->select( $db );
$matched_keys = $Redis->keys( $pattern );
foreach ($matched_keys as $K=>$val){
    $data = $Redis->get('c2e6aa4bbfb9efdeeed54dc9524d80f6');
    print_r($data);
}

$info = $Redis->info();
echo "<pre>";
print_r($matched_keys);
print_r($info);
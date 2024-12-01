<?php

error_reporting(E_ALL);
ini_set('memory_limit', '1024M');

$method = isset($_GET['m'])?$_GET['m']:'';
$action = isset($_GET['a'])?$_GET['a']:'';

$debug = isset($_GET['debug'])?$_GET['debug']:'';

$param = $_GET;

define('LOGPATH',__DIR__."/../../logs/");
 
/*通用的参数*/
/*
*  per_page
*  page
*  begin_time $3
   end_time   $3
   playerid   $4
   server_id  $5
*/
if(!isset($param['per_page'])){
    $param['per_page'] = 100;
}
if(!isset($param['page'])){
    $param['page'] = 1;
}
if(isset($param['begin_time']) && !empty($param['begin_time'])){
    $param['begin_time'] =strtotime($param['begin_time'])*1000;
}else{
    $param['begin_time'] = strtotime(date("Y-m-d"))*1000 ;
}
if(isset($param['end_time']) && !empty($param['end_time'])){
	$log_time =  strtotime($param['end_time']);
    $param['end_time'] = (strtotime($param['end_time'])+86399)*1000;
	
}else{
    $param['end_time'] = strtotime(date("Y-m-d 23:59:59"))*1000;
    $log_time =  strtotime(date("Y-m-d 23:59:59"));
}

$log_path = LOGPATH.date("Y/m",$log_time)."/";
$param['log_path'] = $log_path;
$param['log_time'] = $log_time;

 
$file = __DIR__."/function/{$method}.php";

if($debug){

    var_dump($file,file_exists($file));
    var_dump($action);
    var_dump($param);
}
if(!file_exists($file)){
	  $response = array(
            'status'=>-1,
            'msg'=>'file not exists'
        );
		
}else{
    require $file;
    /**通用的参数*/
 
    $action($param);
}



/***
 * 执行shell 并返回结果
 * @param $cmd
 * @param $param
 * @return array
 */
function exec_cmd($cmd,$param){
    exec($cmd,$res);
	if($_GET['debug']){
		echo $cmd;
	}

    $res = array_reverse($res);
    $total = count($res);
    $total_page = ceil($total/$param['per_page']);
    $offset = $param['page']-1;
    $data = array_slice($res,$offset*$param['per_page'],$param['per_page']);
    $res = array(
        'total'=>$total,
        'per_page'=>$param['per_page'],
        'total_page'=>$total_page,
        'page'=>$param['page'],
        'data'=>$data,
    );
    return $res;
}

/**
 * 返回数据
 * @param $per_page
 * @param $total_page
 * @param $page
 * @param $data
 */
function ajax_return($total,$per_page,$total_page,$page,$data){
    if(!empty($data)){
        $response = array(
            'status'=>0,
            'msg'=>'',
            'data'=>array(
                'total'=>$total,
                'per_page'=>$per_page,
                'total_page'=>$total_page,
                'page'=>$page,
                'list'=>$data
            ),
        );
    }else{
        $response = array(
            'status'=>-1,
            'msg'=>'没有数据'
        );
    }
    echo json_encode($response,JSON_UNESCAPED_UNICODE);
}


//返回当前的毫秒时间戳
function msectime() {
   list($msec, $sec) = explode(' ', microtime());
   $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
   return $msectime;
}
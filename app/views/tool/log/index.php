<?php

/****身份验证****/
error_reporting(E_ALL);
define('LOG_PATH',WEB_PATH.'/log/');
$base_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$filename = isset($_GET['file_name'])?$_GET['file_name']:'';
$filter   = isset($_GET['filter']) &&  !empty($_GET['filter'])?$_GET['filter']:'*';
$download = isset($_GET['download'])?$_GET['download']:'';
$dir 	  = isset($_GET['dir'])&&!empty($_GET['dir'])?urldecode($_GET['dir']):'';
//echo "<pre>";
//print_r($_SERVER);
?>

<?php
if (empty($filename)) {
    $dir = $dir?$dir.'/':'';
    $log_path = LOG_PATH .$dir.$filter;
    $table = '<table  border="1" cellspacing="0" cellpadding="0" align="center" width="900px" style="margin-top: 40px">';
    $table =  $table.' <tr><td class="c1 td2">修改时间</td><td class="c1 td2">目录/文件</td></tr>';
    foreach (glob($log_path) as $k=>$file_path) {
        $file_time = date('Y-m-d H:i:s',filectime($file_path));
        $td = $k%2?'td2':'td1';
        if(is_dir($file_path)){
            $file_path = str_replace(LOG_PATH, '', $file_path);
            $table .= "<tr><td class='c1 {$td}'>{$file_time}</td><td class='c1 {$td}'><a  href='$base_url?&dir={$file_path}'>$file_path<a></td></tr>";
        }else{
            $file_path = str_replace(LOG_PATH, '', $file_path);
            $basename = basename($file_path);
            $table .= "<tr><td class='c1 {$td}'>{$file_time}</td><td class='c1 {$td}'><a  href='$base_url?&file_name={$file_path}'>$basename<a></td></tr>";
        }
    }
    echo $table;
}else{
    if($download){
        ob_end_clean();
        header("Content-Disposition: attachment; filename='{$filename}'");
        readfile(LOG_PATH.$filename);
        exit();
    }else{
        echo $filename."<hr>";
        highlight_file(LOG_PATH.$filename);
    }
}
?>
<style>
    body,td,th {font-family:"宋体"; font-size:12px;}
    /*
    table{border-collapse:collapse;border:1px solid #CCC;background:#efefef;}
    table th{text-align:left; font-weight:bold;height:26px; line-height:26px; font-size:12px; border:1px solid #CCC;}
    table td{height:40px; font-size:16px; border:1px solid #CCC;background-color:#fff;}
    .c1{ width: 120px;}
    .c2{ width: 120px;}
    .c3{ width: 70px;}
    .c4{ width: 80px;}
    .c5{ width: 80px;}
    .c6{ width: 270px;}
    */
    table caption{text-align:left; background-color:#fff; line-height:2em; font-size:16px; font-weight:bold; }
    table { border-collapse: collapse; mso-table-layout-alt: fixed;border: 1px solid rgb(204, 204, 204);background: rgb(239, 239, 239);margin-bottom: 30px;}

    .td1 {height: 50px;font-size: 16px;font-weight:bold;border: 1px solid rgb(204, 204, 204);background-color: rgb(18, 120, 246);border-right: 1pt solid rgb(79, 129, 189);border-top: none;border-bottom: 1pt solid rgb(79, 129, 189);
    }
    .c1 {width: 120px;border-left: 1pt solid rgb(79, 129, 189);
    }
    .c2 {width: 140px;}
    .c3 {width: 70px;}
    .c4 {width: 80px;}
    .c5 {width: 80px;}
    .c6 {width: 270px;}
    .td2 {height: 50px;font-size: 16px;font-weight:bold;border: 1px solid rgb(204, 204, 204);background-color: rgb(255, 255, 255);border-right: 1pt solid rgb(79, 129, 189);border-top: none;border-bottom: 1pt solid rgb(79, 129, 189);}
    tr:hover {background-color: #ffffaa;}
    tr:hover td {background:none;}
</style>
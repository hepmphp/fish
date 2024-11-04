<?php
/**
 *  fiename: fish/Log.php$🐘
 *  date:  2024/10/30   17:11$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\helpers;
class Log
{
    public static $log_path = WEB_PATH.'/log/';
    /**
     * 设置日志路径
     */
    public static function dir($dir_path){
        self::$log_path = $dir_path;
    }
    /***
     *
     * @param $message  消息
     * @param $filename 文件
     * @param $type     日志类型 common普通日志 pay支付日志  login登录日志 user用户日志 等等
     */
    public static function write($message,$filename='user',$type='common'){
        $log_dir = "%s/%s/%s";//日志路径 日志类型 年 月 日
        $dir = sprintf($log_dir,self::$log_path,$type,date('Y/m/d/'));
        if(!is_dir($dir)){
            mkdir($dir,0755,true);
        }
        $log_file = $dir.$filename.'.log';

        $message = date('Y-m-d H:i:s')."\t".$message.PHP_EOL;
        error_log($message,3, $log_file);//接口请求写入日志
    }

    static function file_put_contents($message,$filename='user',$type='common'){
        $log_dir = "%s/%s/%s";//日志路径 日志类型 年 月 日
        $dir = sprintf($log_dir,self::$log_path,$type,date('Y/m/d/'));
        if(!is_dir($dir)){
            mkdir($dir,0755,true);
        }
        $log_file = $dir.$filename.'.log';

        $message = date('Y-m-d H:i:s')."\t".$message.PHP_EOL;
        file_put_contents($log_file,$message);//接口请求写入日志
    }

}
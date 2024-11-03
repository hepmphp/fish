<?php
/**
 *  fiename: fish/Log.php$🐘
 *  date:  2024/10/30   11:17$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace base\middleware;
use base\App;
use base\Event;
use helpers\Input;
use helpers\Log;
use models\curd\AdminLog;

class LogMiddleware{
    public function handle($handler,$next){
    
//        $admin_log = new AdminLog();
//        $app = App::get_instance(WEB_PATH);
//        $controller = "{$app->path}/{$app->controller}";
//        $method = "{$app->method}";
//        if(in_array($method,['create','update','delete','edit_permission'])){
//            $config = [
//                'create'=>1,
//                'update'=>2,
//                'delete'=>3,
//                'login'=>4,
//                'login_fail'=>5,
//                'edit_permission'=>6
//            ];
//            $log_type = isset($config[$method])?$config[$method]:1;
//
//            $ip = Input::get_client_ip();
//            $data = [
//                'user_id'=>$_SESSION['admin_user_id'],
//                'platform_id'=>0,
//                'username'=>$_SESSION['admin_user_username'],
//                'ip'=>$ip,
//                'm'=>$controller,
//                'a'=>$method,
//                'addtime'=>time(),
//                'log_type'=>$log_type,
//                'info'=>json_encode(print_r($GLOBALS,true)),
//                'status'=>1
//            ];
//            $admin_log->create($data);
        }
        return $next($handler);
    }
}
<?php
/**
 *  fiename: fish/AuthMiddleware.php$🐘
 *  date:  2024/10/30   18:28$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace base\middleware;
use helpers\Cookie;
use helpers\Session;

class AuthMiddleware{
    public function handle($handler,$next){
        $welcome_url = "http://{$_SERVER['HTTP_HOST']}/admin/user/welcome";
        $has_session_logined = Session::get('admin_user_id');
        $is_in_login_url = $_SERVER['PATH_INFO']=='/admin/user/login'?true:false;
        if($has_session_logined && $is_in_login_url){
            header("Location:{$welcome_url} ");
            exit();
        }else{
            $no_from_backend =  isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'],'backend')==-1?true:false;
            $has_cookie_logined = Cookie::get('admin_cookie');
            if($has_cookie_logined  && $is_in_login_url && $no_from_backend){
                header("Location:{$welcome_url}");
                exit();
            }
        }

        return $next($handler);
    }
}
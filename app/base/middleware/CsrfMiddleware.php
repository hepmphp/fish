<?php
/**
 *  fiename: fish/CsrfMiddleware.php$🐘
 *  date:  2024/10/31   23:46$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace  base\middleware;
use base\exception\LogicException;
use helpers\Cookie;
use helpers\Input;
use helpers\Msg;
use helpers\Session;

class CsrfMiddleware{
    public function handle($handler,$next){
        $csrf_token = Cookie::get('_csrf_token');
        $session_csrf_token = Session::get('_csrf_token');
        if($csrf_token !=$session_csrf_token){
            if(Input::is_ajax()){
                throw new LogicException(-100,'跨站请求伪造攻击!!!');
            }else{
                Msg::show_msg('跨站请求伪造攻击', "http://{$_SERVER['HTTP_HOST']}/admin/user/login?from=backend");
                exit();
            }
        }

        return $next($handler);
    }

}
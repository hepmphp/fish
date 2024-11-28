<?php
/**
 *  fiename: fish/CsrfMiddleware.php$🐘
 *  date:  2024/10/31   23:46$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace  app\base\middleware;
use app\base\exception\LogicException;
use app\helpers\Cookie;
use app\helpers\Input;
use app\helpers\Msg;
use app\helpers\Session;

class CsrfMiddleware{
    public function handle($handler,$next){

        if($_SERVER['REQUEST_URI']=='/admin/user/ding_login'||$_SERVER['REQUEST_URI']=='/admin/user/ding_login_return'
        ||strpos("/admin/user/ding_login_return?exert=test&code=4b3b66c2c7003cb9836f887ce2472e6c&state=STATE","ding")!=false
        ){
            return $next($handler);
        }
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
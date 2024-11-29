<?php
/**
 *  fiename: fish/Filter.php$🐘
 *  date:  2024/10/30   11:17$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\base\middleware;
use app\base\App;
use app\base\exception\LogicException;
use app\helpers\Cookie;
use app\helpers\Input;
use app\helpers\Msg;
use app\helpers\Session;
use app\models\curd\AdminMenu;
use app\models\curd\AdminUser;

class SessionMiddleware{
    public function handle($handler,$next){
        if($_SERVER['PATH_INFO']=='/'){
            return true;
        }
        if($_SERVER['PATH_INFO']=='/api/captcha/get'||$_SERVER['PATH_INFO']=='/favicon.ico'||$_SERVER['REQUEST_URI']=='/admin/user/ding_login'
            ||strpos($_SERVER['REQUEST_URI'],"ding")!=false
            ||strpos($_SERVER['REQUEST_URI'],"debug")!=false
            ||strpos($_SERVER['REQUEST_URI'],"login")!=false
        ){
            return $next($handler);
            exit();
        }
        $is_in_login_url = $_SERVER['PATH_INFO']=='/admin/user/login'?true:false;
        if(isset($_SESSION['admin_user_id']) && $_SESSION['admin_user_id']){
            $admin_user_model = new AdminUser();
            $admin_user = $admin_user_model->info(['id'=>$_SESSION['admin_user_id']]);
            if($admin_user['status']!=0){
                if(Input::is_ajax()){
                    throw new LogicException(-100,'您的账号已经锁定,请联系管理员处理');
                }else{
                    if(!$is_in_login_url) {
                        Msg::show_msg('您的账号已经锁定,请联系管理员处理', "http://{$_SERVER['HTTP_HOST']}/admin/user/login?from=backend");
                        exit();
                    }
                }
            }
            $is_logined_in_other_place = $_SESSION['admin_user_allow_mutil_login']==1 && $_SESSION['admin_user_session_id']!=$admin_user['last_session_id']?true:false;
            if($is_logined_in_other_place){
                Session::session_destroy();
                Cookie::clear();
                if(Input::is_ajax()){
                    throw new LogicException(-100,'您的账号已经在其它地方登录');
                }else{
                    if(!$is_in_login_url) {
                        Msg::show_msg('您的账号已经在其它地方登录', "http://{$_SERVER['HTTP_HOST']}/admin/user/login?from=backend");
                        exit();
                    }
                }
            }
        }else{
            if(!Input::is_ajax() && !$is_in_login_url) {
                Msg::show_msg('您的账号已经在其它地方登录', "http://{$_SERVER['HTTP_HOST']}/admin/user/login?from=backend");
                exit();
            }
        }

        $app = App::get_instance(WEB_PATH);
        $controller = " model='{$app->path}/{$app->controller}'";
        $method = " action='{$app->method}'";
        $where = $controller.' AND '.$method;
        $admin_menu_model = new AdminMenu();
        $admin_menu = $admin_menu_model->info($where);

        if(!empty($admin_menu) && isset($admin_menu['id']) && isset($_SESSION['admin_user_mids'])){
            if(!in_array($admin_menu['id'],$_SESSION['admin_user_mids'])){  //权限检查
                if(Input::is_ajax()) {
                    throw new LogicException(-100, '您没有权限访问:)');
                }else{
                    Msg::show_msg('您没有权限访问:)', "http://{$_SERVER['HTTP_HOST']}/admin/user/welcome?iframe=0");
                    exit();
                }
            }
        }

        return $next($handler);
    }
}
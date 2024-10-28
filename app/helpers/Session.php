<?php
/**
 *  fiename: fish/Session.php$🐘
 *  date: 2024/10/18 15:18:36$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace helpers;
use base\App;
use base\session\SessionRedis;

class Session{
    /**
     * @brief   diy_session_destroy     彻底注销session
     *
     * @Returns NUL
     */
    public static function  session_destroy(){
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 86400, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }

    public static function set($key,$value){
        $_SESSION[$key] = $value;
    }

    public static function get($key){
        $data = isset($_SESSION[$key])?$_SESSION[$key]:array();
        return $data;
    }

    /**
     * session初始化 配置
     */
    public static function init($session=''){
        if(empty($session)){
            $session =  App::get_instance(APP_PATH)::$config['session']['session'];
            $config = $session['SESSION_OPTIONS'];
        }

        ini_set('session.auto_start', 0);
        if(isset($config['name']))            session_name($config['name']);
        if(isset($config['path']))            session_save_path($config['path']);
        if(isset($config['domain']))          ini_set('session.cookie_domain', $config['domain']);
        if(isset($config['expire']))          ini_set('session.gc_maxlifetime', $config['expire']);
        if(isset($config['use_trans_sid']))   ini_set('session.use_trans_sid', 1);
//        if(isset($config['use_cookies']))     ini_set('session.use_cookies', $config['use_cookies']?1:0);
//        if(isset($config['cache_limiter']))   session_cache_limiter($config['cache_limiter']);
//        if(isset($config['cache_expire']))    session_cache_expire($config['cache_expire']);
        if($session['SESSION_TYPE']=='Redis'){
            $hander = new SessionRedis($config['path']);
            $hander->execute();
        }

        // 启动session
        if(!empty($session['SESSION_AUTO_START']))
        {
            session_start();
        }

    }


    /**
     * @brief   cncn_session_start   自定义开启session
     *
     * @Param   $limiter            浏览器缓存，默认session_start()是nocache
     *
     * @Returns
     */
    public static function  session_start($limiter = ''){
        if (session_id() == '') {
            //ini_set('session.name', 'MYSESSNAME');      //自定义session_name
            ini_set('session.cookie_httponly', 1);      //开启http-only,防止客户端js通过xss盗取cookie

            if (in_array($limiter, array('public', 'private', 'nocache', 'private_no_expire'))) {
                session_cache_limiter($limiter);        //参考:http://www.9enjoy.com/pragma-no-cache-session/
            }

            ini_set('session.gc_maxlifetime', 4*3600);    //session过期时间，启动垃圾回收机制


            session_start();
        }

    }

}
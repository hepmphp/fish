<?php
/**
 *  fiename: fish/Cookie.php$🐘
 *  date: 2024/10/18 16:17:15$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace helpers;


use base\App;
use helpers\Security\DzAuth;

class Cookie {
    // 判断Cookie是否存在
    static function is_set($name) {
        $cookie = App::get_instance(APP_PATH)::$config['config']['cookie'];
        return isset($_COOKIE[$cookie['COOKIE_PREFIX'].$name]);
    }

    // 获取某个Cookie值
    static function get($name) {
        $cookie = App::get_instance(APP_PATH)::config['config']['cookie'];
        $value   = $_COOKIE[$cookie['COOKIE_PREFIX'].$name];
        $value   =  unserialize(DzAuth::authcode($value));
        return $value;
    }

    // 设置某个Cookie值
    static function set($name,$value,$expire='',$path='',$domain='') {
        $cookie = App::get_instance(APP_PATH)::$config['config']['cookie'];
        if($expire=='') {
            $expire =   $cookie['COOKIE_EXPIRE'];
        }
        if(empty($path)) {
            $path = $cookie['COOKIE_PATH'];
        }
        if(empty($domain)) {
            $domain =   $cookie['COOKIE_DOMAIN'];
        }
        $expire =   !empty($expire)?    time()+$expire   :  0;
        $value   =  DzAuth::authcode(serialize($value),'ENCODE');
        setcookie($cookie['COOKIE_PREFIX'].$name, $value,$expire,$path,$domain);
        $_COOKIE[$cookie['COOKIE_PREFIX'].$name]  =   $value;
    }

    // 删除某个Cookie值
    static function delete($name) {
        $cookie = App::get_instance(APP_PATH)::$config['config']['cookie'];
        Cookie::set($name,'',-3600);
        unset($_COOKIE[$cookie['COOKIE_PREFIX'].$name]);
    }

    // 清空Cookie值
    static function clear() {
        unset($_COOKIE);
    }
}
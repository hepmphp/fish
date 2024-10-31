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

    static function get_config(){
        return App::get_instance(APP_PATH)::$config['cookie']['cookie'];
    }

    // 判断Cookie是否存在
    static function is_set($name) {
        $config = self::get_config();
        return isset($_COOKIE[$config['COOKIE_PREFIX'].$name]);
    }

    // 获取某个Cookie值
    static function get($name) {
        $config = self::get_config();
        $value = '';
        if(isset($_COOKIE[$config['COOKIE_PREFIX'].$name])){
            $value   = $_COOKIE[$config['COOKIE_PREFIX'].$name];
            $decode_value = DzAuth::authcode($value);
            $value   =  unserialize($decode_value);
        }
        return $value;
    }

    static function set_all($cookies,$expire='',$path='',$domain=''){
        $config = self::get_config();
        if($expire=='') {
            $expire =   $config['COOKIE_EXPIRE'];
        }
        if(empty($path)) {
            $path = $config['COOKIE_PATH'];
        }
        if(empty($domain)) {
            $domain =   $config['COOKIE_DOMAIN'];
        }
        $expire =   !empty($expire)?    time()+$expire   :  0;
        foreach ($cookies as $name=>$value){
            $value   =  DzAuth::authcode(serialize($value),'ENCODE');
            setcookie($config['COOKIE_PREFIX'].$name, $value,$expire,$path,$domain);
            $_COOKIE[$config['COOKIE_PREFIX'].$name]  =   $value;
        }
    }

    // 设置某个Cookie值
    static function set($name,$value,$expire='',$path='',$domain='') {
        $config = self::get_config();
        if($expire=='') {
            $expire =   $config['COOKIE_EXPIRE'];
        }
        if(empty($path)) {
            $path = $config['COOKIE_PATH'];
        }
        if(empty($domain)) {
            $domain =   $config['COOKIE_DOMAIN'];
        }
        $expire =   !empty($expire)?    time()+$expire   :  0;
        $value   =  DzAuth::authcode(serialize($value),'ENCODE');
        setcookie($config['COOKIE_PREFIX'].$name, $value,$expire,$path,$domain);
        $_COOKIE[$config['COOKIE_PREFIX'].$name]  =   $value;
    }

    // 删除某个Cookie值
    static function delete($name) {
        $config = self::get_config();
        Cookie::set($name,'',-3600);
        unset($_COOKIE[$config['COOKIE_PREFIX'].$name]);
    }

    // 清空Cookie值
    static function clear() {
        unset($_COOKIE);
    }
}
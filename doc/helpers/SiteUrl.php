<?php
/**
 *  fiename: fish/SiteUrl.php$🐘
 *  date:  2024/11/7   16:56$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace doc\helpers;

class  SiteUrl{
    static function get_image_url($file){
        return "http://127.0.0.1:2222/upload/".$file;
    }
    static function get_avator_url($avator){
        return STATIC_URL.'image/avator/'.$avator;
    }

    static function get_stamp_url($stamp){
        return STATIC_URL.'/image/stamp/'.$stamp;
    }


}
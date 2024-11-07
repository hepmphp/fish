<?php
/**
 *  fiename: fish/SiteUrl.php$🐘
 *  date:  2024/11/7   16:56$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\helpers;

class  SiteUrl{
    static function get_image_url($file){
        return SITE_URL."upload/".$file;
    }

    static function get_stamp_url($stamp){
        return 'http://127.0.0.1:2222/static/bbs/image/stamp/'.$stamp;
    }
}
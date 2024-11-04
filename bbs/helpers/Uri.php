<?php
namespace cms\helpers;
/**
 *  fiename: fish/Uri.php$🐘
 *  date:  2024/11/3   8:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
class Uri
{
    static function list_href($id){

        return '/cms.php/web/catelist/index?id='.$id.'.html';
    }
    static function detail_href($id){
        #/web/detail/index?id=1
        return '/cms.php/web/detail/index?id='.$id.'.html';
    }
}
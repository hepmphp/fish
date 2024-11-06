<?php
namespace bbs\helpers;
/**
 *  fiename: fish/Uri.php$🐘
 *  date:  2024/11/3   8:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
class Uri
{

    static function list_href($id){

        return '/bbs.php/web/bbs-list/index?id='.$id.'.html';
    }
    static function detail_href($id){
        #/web/detail/index?id=1
        return '/bbs.php/web/question/index?id='.$id.'.html';
    }
    static function update_href($id){
        #/web/detail/index?id=1
        return '/bbs.php/web/ask/update?id='.$id.'.html';
    }
    static function ask_href($id){
        return '/bbs.php/web/ask/index?id='.$id.'.html';
    }
}
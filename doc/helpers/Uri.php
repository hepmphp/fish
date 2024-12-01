<?php
namespace doc\helpers;
/**
 *  fiename: fish/Uri.php$🐘
 *  date:  2024/11/3   8:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
class Uri
{

    static function bbs_list_index_href($id){

        return  SITE_URL.'/web/bbs_list/index?id='.$id;
    }

    static function bbs_list_href($id){
        return  SITE_URL.'/web/bbs_list/list?id='.$id;
    }

    static function bbs_list_create(){
        return  SITE_URL.'/web/bbs_list/create';
    }

    static function detail_href($id){
        #/web/detail/index?id=1
        return SITE_URL.'/web/question/index?id='.$id;
    }
    static function update_href($id){
        #/web/detail/index?id=1
        return  SITE_URL.'/web/ask/update?id='.$id;
    }
    static function ask_href($id){
        return  SITE_URL.'/web/ask/index?id='.$id;
    }
    static function ask_create_href($id){
        return  SITE_URL.'/web/ask/create?id='.$id;
    }

    static function question_href($id){
        return  SITE_URL.'/web/question/index?id='.$id;
    }
    static function user_bbslist_href($id){
        return  SITE_URL.'/web/user/bbslist?user_id='.$id;
    }
    //bbs.php/web/user/bbslist

}
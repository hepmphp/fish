<?php
/**
 *  fiename: fish/SearchController.php$🐘
 *  date:  2024/11/4   16:51$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\helpers\developer;
class SearchController {

    public static function get_config_search_builder_type(){
        $config = array(
            'search_none'=>'0.请选择',
            'search_text'=>'1.文本搜索',
            'search_select'=>'2.下拉框搜索',
            'search_like'=>'3.like搜索',
            'search_time'=>'4.时间搜索',

        );
        return $config;
    }
}
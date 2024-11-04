<?php
/**
 *  fiename: fish/PageWidget.php$🐘
 *  date: 2024/10/22 18:06:07$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\helpers;

class PageWidget{

    static function run()
    {
        $widget_file = file_get_contents(APP_PATH.'views/widget/index.php');
        echo $widget_file;
    }



}
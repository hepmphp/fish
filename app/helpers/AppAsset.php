<?php
/**
 *  fiename: fish/AppAsset.php$🐘
 *  date: 2024/10/22 18:18:05$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\helpers;

class AppAsset{
    public static $js_files = [
        'js/jquery.min.js',
        'js/jquery.cookie.js',
        'js/page.js',
        'js/bootstrap.min.js',
        'js/date/moment.min.js',#<!--日期-->
        'js/date/jquery.daterangepicker.js',
        'js/layer/layer.js',
        'js/logic/admin/ajax.js',
    ];

    public static $js_files_end =[
        'js/bootstrap-table/bootstrap-table.min.js',
        'js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js',
        'js/table-demo.js',
    ];

    public static $css_files =[
        'css/bootstrap.min.css',#<!--全局样式-->
        'css/style.css',#<!--全局样式-->
//        'css/screen.css',#<!--全局样式-->
        'css/font-awesome.min.css',#<!--图标-->
        'js/bootstrap-table/bootstrap-table.min.css',#<!--表单表格-->
        'css/form.css',#<!--表单表格-->
        'js/date/daterangepicker.css',#<!--日期-->
        'css/mobile.css',
        'js/layer/layui/layui.css'

    ];

    static function register_javascript($is_end=0){
        $js_files = $is_end?self::$js_files_end:self::$js_files;
        foreach ($js_files as $js){
            $js = STATIC_URL.$js.'?'.rand();
            echo <<<EOT
    <script  src="$js"></script>\n
EOT;
        }
    }
    static function register_css(){
        foreach (self::$css_files as $css) {
            $css = STATIC_URL . $css.'?'.rand();
            echo <<<EOT
    <link href="$css" rel="stylesheet">\n
EOT;
        }

    }

    static function run_javascript_end(){
        self::register_javascript(1);
    }
    static function run(){
        self::register_javascript();
        self::register_css();
    }
}
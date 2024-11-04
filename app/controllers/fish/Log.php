<?php
/**
 *  fiename: fish/Log.php$🐘
 *  date:  2024/11/1   0:38$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\fish;

use app\base\BaseController;

class Log extends BaseController{

    public function index(){
        $key = md5('hepm_123456'.date("Ymd"));
        $url   = SITE_URL.'/tool/log.php?token='.$key;
        echo <<<HTML
 <iframe id="J_iframe" class="iframe-box" name="J_iframe" width="100%" height="100%" SRC="{$url}"></iframe>
HTML;

    }
}
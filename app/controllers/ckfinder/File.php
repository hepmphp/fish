<?php
/**
 *  fiename: fish/file.php$🐘
 *  date:  2024/10/25   21:18$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\ckfinder;

include WEB_PATH.'/../vendor/plugin/ckfinder/core/connector/php/vendor/autoload.php';
use CKSource\CKFinder\CKFinder;
use app\base\BaseController;
class File extends BaseController{

    public function index(){
        $ckfinder = new CKFinder( WEB_PATH.'/../vendor/plugin/ckfinder/config.php');
        $ckfinder->run();
    }
}

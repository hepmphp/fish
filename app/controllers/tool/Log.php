<?php
/**
 *  fiename: fish/Log.php$🐘
 *  date:  2024/11/1   0:38$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\tool;

use app\base\BaseController;

class Log extends BaseController{

    public function index(){
        $this->view->display('tool/log/index');
    }
}
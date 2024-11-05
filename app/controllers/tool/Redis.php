<?php
/**
 *  fiename: fish/Redis.php$🐘
 *  date:  2024/11/5   22:29$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\tool;

use app\base\BaseController;

class Redis extends BaseController{

    public function index(){

        $this->view->display('tool/redis/index');
    }
}

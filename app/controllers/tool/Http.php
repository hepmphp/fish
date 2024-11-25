<?php
/**
 *  fiename: fish/Http.php$🐘
 *  date:  2024/11/25   17:23$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\controllers\tool;
use app\base\BaseController;
class Http extends BaseController{
    public function index(){
        $this->view->display('tool/http/index');
    }
}
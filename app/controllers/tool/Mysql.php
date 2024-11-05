<?php
/**
 *  fiename: fish/Mysql.php$🐘
 *  date:  2024/11/5   21:28$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\tool;
use app\base\BaseController;
class Mysql extends BaseController{
    public function index(){
        $this->view->display('tool/mysql/index');
    }
}
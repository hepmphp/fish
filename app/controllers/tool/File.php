<?php
/**
 *  fiename: fish/File.php$🐘
 *  date:  2024/11/5   19:41$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\controllers\tool;

use app\base\BaseController;


class File extends BaseController {

    public function index(){
        $this->view->display('tool/file/index');
    }
}
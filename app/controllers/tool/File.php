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
        echo <<<HTML
<iframe src="http://127.0.0.1/tool/file.php" width="100%" height="100%"></iframe>
HTML;

//        $this->view->display('tool/file/index');
    }
}
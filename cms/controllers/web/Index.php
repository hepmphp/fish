<?php
/**
 *  fiename: fish/Index.php$🐘
 *  date:  2024/11/2   23:42$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace cms\controllers\web;

use cms\base\CmsController;


class Index extends CmsController{


    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $data = [];
        $this->view->display('cms/web/index');
    }

}

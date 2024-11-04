<?php
/**
 *  fiename: fish/Index.php$🐘
 *  date:  2024/11/2   23:42$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace bbs\controllers\web;

use bbs\base\BbsController;

class Index extends BbsController{


    public function __construct()
    {

        parent::__construct();

    }

    public function index(){
        $this->view->display('web/index');

    }


}

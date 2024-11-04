<?php
/**
 *  fiename: fish/Article.php$🐘
 *  date:  2024/11/4   22:48$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace bbs\controllers\web;

use bbs\base\BbsController;
class Ask extends BbsController{
    public function __construct()
    {

        parent::__construct();

    }

    public function index(){
        $this->view->display('web/ask');

    }


}
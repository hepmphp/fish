<?php
/**
 *  fiename: fish/Index.php$🐘
 *  date:  2024/11/2   23:42$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace doc\controllers\web;

use app\helpers\Input;
use doc\base;
use doc\base\DocController;


class File extends DocController{

    public $forum = array();
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->view->display('web/index/index');
    }

    public function upload(){
        $this->view->display('web/index/upload');
    }
}

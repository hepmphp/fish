<?php
/**
 *  fiename: fish/Index.php$🐘
 *  date:  2024/11/2   23:42$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace im\controllers\web;

use app\helpers\Input;
use im\base\ImController;


class Index extends ImController{

    public $forum = array();
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        error_log(12,3,'E:\data\www\web-demo\web-socket\on-meessage.log');
         echo "aaaaaaaaaaaaaaaaaaa";
        $this->view->display('web/index/index');
    }


}

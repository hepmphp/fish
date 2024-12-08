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
         echo "aaaaaaaaaaaaaaaaaaa";
        $this->view->display('web/index/index');
    }

    public function talk(){
        $this->view->display('web/index/talk');
    }

    public function talk_to(){
        $this->view->display('web/index/talk_to');
    }
    public function talk_three(){
        $this->view->display('web/index/talk_three');
    }
}

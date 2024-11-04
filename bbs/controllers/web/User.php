<?php
/**
 *  fiename: fish/User.php$🐘
 *  date:  2024/11/4   22:59$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace bbs\controllers\web;

use bbs\base\BbsController;
class User extends BbsController{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->view->display('web/user/index');
    }

    public function register(){
        $this->view->display('web/user/register');
    }

    public function password(){
        $this->view->display('web/user/password');
    }
    public function find_password(){
        $this->view->display('web/user/find_password');
    }

}
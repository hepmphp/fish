<?php
/**
 *  fiename: fish/BaseController.php$🐘
 *  date: 2024/10/18 11:28:50$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace Im\base;

use app\base\PhpView;
use app\base\SmartyView;
use app\helpers\Input;
use im\base\ImApp;


class ImController{
    public $app = null;
    public $render_engine = 'php';
    public $view;

    public function __construct() {
        $this->app = ImApp::get_instance(IM_PATH);
        $this->make_view();
    }

    public function make_view() {
        if (!$this->render_engine) {
            return false;
        }
        $view_path = IM_PATH.'views/';
        if ($this->render_engine === 'Smarty') {
            $smarty_view          = new SmartyView($view_path);
            $this->view           = $smarty_view;
        } else {
            $this->view = new PhpView($view_path);
        }
    }

    public function __destruct(){
    }



}
<?php
/**
 *  fiename: fish/BaseController.php$🐘
 *  date: 2024/10/18 11:28:50$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace doc\base;

use app\base\PhpView;
use app\base\SmartyView;
use app\helpers\Input;
use doc\base\DocApp;


class DocController{
    public $app = null;
    public $render_engine = 'php';
    public $view;

    public function __construct() {

        $this->app = DocApp::get_instance(DOC_PATH);
        $this->make_view();
    }

    public function make_view() {
        if (!$this->render_engine) {
            return false;
        }
        $view_path = DOC_PATH.'views/';
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
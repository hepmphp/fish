<?php
/**
 *  fiename: fish/BaseController.php$🐘
 *  date: 2024/10/18 11:28:50$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace bbs\base;

use app\base\PhpView;
use app\base\SmartyView;


class BbsController{
    public  $app = null;
    public $render_engine = 'php';
    public $view;
    public $article_category=array();
    public $html_cache = '';
    public function __construct() {

        $this->app = BbsApp::get_instance(BBS_PATH);
        $this->make_view();

    }

    public function make_view() {
        if (!$this->render_engine) {
            return false;
        }
        $view_path = BBS_PATH.'views/';
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
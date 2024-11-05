<?php
/**
 *  fiename: fish/BaseController.php$🐘
 *  date: 2024/10/18 11:28:50$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace bbs\base;

use app\base\PhpView;
use app\base\SmartyView;
use bbs\models\Forum;


class BbsController{
    public  $app = null;
    public $render_engine = 'php';
    public $view;
    public $article_category=array();
    public $html_cache = '';
    public $forum = '';
    public function __construct() {

        $this->app = BbsApp::get_instance(BBS_PATH);
        $this->make_view();
        $this->forum = new Forum();
        $form_list = $this->forum->find_all('',1,100,'*');
        $this->view->assign('forum_list',$form_list);

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
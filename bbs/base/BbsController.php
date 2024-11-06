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
use bbs\models\User as M_User;


class BbsController{
    public  $app = null;
    public $render_engine = 'php';
    public $view;
    public $article_category=array();
    public $html_cache = '';
    public $forum = '';
    public $user = array();
    public $bbs_user = array();
    public function __construct() {

        $this->app = BbsApp::get_instance(BBS_PATH);
        $this->make_view();
        $this->forum = new Forum();
        $this->user = new M_User();
        if(isset($_SESSION['bbs_user_id'])){
            $this->bbs_user = $this->user->info(['id'=>$_SESSION['bbs_user_id']]);
        }


        $form_list = $this->forum->find_all('',1,100,'*');
        $config_menu = $this->forum->get_config_menu([]);

        $this->view->assign('forum_list',$form_list);
        $this->view->assign('bbs_user',$this->bbs_user);
        $this->view->assign('config_menu',$config_menu);
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
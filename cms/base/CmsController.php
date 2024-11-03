<?php
/**
 *  fiename: fish/BaseController.php$🐘
 *  date: 2024/10/18 11:28:50$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace cms\base;
use cms\models\FriendLink;
use helpers\Arr;
use helpers\Cookie;
use base\PhpView;
use base\SmartyView;
use helpers\Session;
use cms\models\ArticleCategory;

class CmsController{

    public  $app = null;

    public $render_engine = 'php';

    public $view;

    public $admin_menu;
    public $article_category=array();
    public function __construct() {
        $this->app = CmsApp::get_instance(CMS_PATH);
        $this->make_view();
        $this->article_category = new ArticleCategory();
        list($data,$children) = $this->article_category->get_menus();

        $friend_linsk = (new FriendLink())->get_find_all();
        $this->view->assign('menu_data',$data);
        $this->view->assign('menu_children',$children);
        $this->view->assign('friend_linsk',$friend_linsk);
        $_csrf_token = md5($_SERVER['REQUEST_URI']);
        Cookie::set('_csrf_token',$_csrf_token);
        Session::set('_csrf_token',$_csrf_token);
    }

    public function make_view() {
        if (!$this->render_engine) {
            return false;
        }
        $view_path = CMS_PATH.'views/';
        if ($this->render_engine === 'Smarty') {
            $smarty_view          = new SmartyView($view_path);
            $this->view           = $smarty_view;
        } else {
            $this->view = new PhpView($view_path);
        }
    }

}
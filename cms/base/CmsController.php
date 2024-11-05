<?php
/**
 *  fiename: fish/BaseController.php$🐘
 *  date: 2024/10/18 11:28:50$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace cms\base;
use cms\models\FriendLink;
use app\base\PhpView;
use app\base\SmartyView;
use cms\models\ArticleCategory;
use cms\helpers\HtmlCache;

class CmsController{
    public  $app = null;
    public $render_engine = 'php';
    public $view;
    public $article_category=array();
    public $html_cache = '';
    public function __construct() {
        $this->app = CmsApp::get_instance(CMS_PATH);
        $this->make_view();
//        $this->html_cache = new HtmlCache($this->view,$this->app::$config['routers'],$this->app::$config['redis']['redis']);
//        $this->html_cache->start();
        $this->article_category = new ArticleCategory();
        list($data,$children) = $this->article_category->get_menus();
        $friend_linsk = (new FriendLink())->get_find_all();
        $this->view->assign('menu_data',$data);
        $this->view->assign('menu_children',$children);
        $this->view->assign('friend_linsk',$friend_linsk);
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

    public function __destruct(){
//        $this->html_cache->end();
    }



}
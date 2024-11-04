<?php
/**
 *  fiename: fish/BaseController.php$🐘
 *  date: 2024/10/18 11:28:50$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\base;
use app\helpers\Cookie;
use app\helpers\Input;
use app\base\Url;
use app\base\App;
use app\base\PhpView;
use app\base\SmartyView;
use app\helpers\Session;
use app\models\curd\AdminMenu;

class BaseController{

    public  $app = null;

    public $render_engine = 'php';

    public $view;

    public $admin_menu;


    public function __construct() {
        if(strpos($_SERVER['REQUEST_URI'],'/api/')!==-1){//api请求不加载页面及菜单
            $this->app = \app\base\App::get_instance(APP_PATH);
            $this->make_view();
            $this->admin_menu = new AdminMenu();
            //获取上边菜单和左侧菜单
            list($top_menu,$left_menu,$left_menu_child,$top_menu_id) = $this->admin_menu->get_top_left_menu($this->app::$config['routers']);
            $this->view->assign('top_menu',$top_menu);
            $this->view->assign('left_menu',$left_menu);
            $this->view->assign('left_menu_child',$left_menu_child);
            $this->view->assign('top_menu_id',$top_menu_id);
            $_csrf_token = md5('_fish_token');
            Cookie::set('_csrf_token',$_csrf_token);
            Session::set('_csrf_token',$_csrf_token);
        }
    }

    public function make_view() {
        if (!$this->render_engine) {
            return false;
        }
        $view_path = APP_PATH.'views/';
        if ($this->render_engine === 'Smarty') {
            $smarty_view          = new SmartyView($view_path);
            $this->view           = $smarty_view;
        } else {
            $this->view = new PhpView($view_path);
        }
    }

    public function get_debug(){
        Input::ajax_debug();
    }



}
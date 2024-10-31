<?php
/**
 *  fiename: fish/BaseController.php$🐘
 *  date: 2024/10/18 11:28:50$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace base;
use helpers\Cookie;
use helpers\Input;
use base\App;
use base\PhpView;
use base\SmartyView;
use helpers\Session;
use models\curd\AdminMenu;

class BaseController{

    public  $app = null;

    public $render_engine = 'php';

    public $view;

    public $admin_menu;


    public function __construct() {
        if(strpos($_SERVER['REQUEST_URI'],'/api/')!==-1){//api请求不加载页面及菜单
            $this->app = \base\App::get_instance(APP_PATH);
            $this->make_view();
            $this->admin_menu = new AdminMenu();
            $menu_id_arr = isset($_SESSION['admin_user_mids'])?$_SESSION['admin_user_mids']:0;
            $admin_menu_where['level'] = 0;
            if(!empty($menu_id_arr)){
                $admin_menu_where['id'] = $menu_id_arr;
            }
            $top_menu = $this->admin_menu->get_top_menu($admin_menu_where);
            list($left_menu,$left_menu_child) = $this->admin_menu->get_left_menu($menu_id_arr);

            $this->view->assign('top_menu',$top_menu);
            $this->view->assign('left_menu',$left_menu);
            $this->view->assign('left_menu_child',$left_menu_child);
            $_csrf_token = md5($_SERVER['REQUEST_URI']);
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
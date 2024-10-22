<?php
/**
 *  fiename: fish/BaseController.php$🐘
 *  date: 2024/10/18 11:28:50$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace base;
use helpers\Input;
use base\App;
use base\PhpView;
use base\SmartyView;
use models\curd\AdminMenu;

class BaseController{

    public  $app = null;

    public $render_engine = 'php';

    public $view;

    public $admin_menu;


    public function __construct() {
        $this->app = \base\App::get_instance(APP_PATH);
        $this->make_view();
        $this->admin_menu = new AdminMenu();
        $top_menu = $this->admin_menu->get_top_menu(0);
        list($left_menu,$left_menu_child) = $this->admin_menu->get_left_menu();
        $this->view->assign('top_menu',$top_menu);
        $this->view->assign('left_menu',$left_menu);
        $this->view->assign('left_menu_child',$left_menu_child);
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
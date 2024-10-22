<?php
/**
 *  fiename: fish/User.php$🐘
 *  date: 2024/10/20 20:44:38$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\admin;
use base\exception\LogicException;
use helpers\Input;
use models\curd\AdminMenu;
use models\curd\AdminUser;

class  User extends \base\BaseController{

    public $admin_menu;

    public function __construct()
    {
        $this->admin_menu = new AdminMenu();
        parent::__construct();
    }

    public function get_search_where(){
        $where['username'] = Input::get_post('username');
        return $where;
    }

    public function index(){
        $data['admin_url'] = '/admin/menu/get_list';
        $data['username'] = Input::get_post('username');

        $this->view->assign('data',$data);
        $this->view->display('admin/index');
    }


    public function get_list(){
        $data = $this->get_search_where();
        $this->view->assign('data',$data);
        $this->view->display('admin/user/user_list');
    }

    public function user_info(){
        $this->view->display('admin/user_info');
    }

}

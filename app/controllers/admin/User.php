<?php
/**
 *  fiename: fish/User.php$🐘
 *  date: 2024/10/20 20:44:38$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\admin;
use base\exception\LogicException;
use helpers\Input;
use models\curd\AdminUser;

class  User extends \base\BaseController{

    public $admin_user;

    public function __construct()
    {
        $this->admin_user = new AdminUser();
        parent::__construct();
    }

    public function get_search_where(){
        $where['username'] = Input::get_post('username');
        return $where;
    }

    public function index(){
        $data['admin_url'] = '/admin/user/get_list';
        $data['username'] = Input::get_post('username');

        $this->view->assign('data',$data);
        $this->view->display('admin/index');
    }

    public function login(){
        $this->view->display('admin/login');
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page');
        $per_page = Input::get_post('per_page');
        $data = $this->admin_user->get_list_info($where,$per_page,$page,'*');
        $this->view->assign('data',$data);
        $this->view->display('admin/user_list');
    }

    public function user_info(){
        $this->view->display('admin/user_info');
    }

}

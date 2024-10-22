<?php
/**
 *  fiename: fish/User.php$🐘
 *  date: 2024/10/20 20:44:38$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\admin;
use helpers\Input;
use models\curd\AdminMenu;
use models\curd\AdminUser;

class  User extends \base\BaseController{

    public $admin_user;
    public $admin_menu;

    public function __construct()
    {
        $this->admin_user = new AdminUser();
        parent::__construct();
    }

    public function get_search_where(){
        $where['username'] = Input::get_post('username');
        $where['level']    = 0;
        if(isset($_GET['level'])){
            $level = Input::get_post('level',0);
            $where['level'] = intval($level);
        }

        return $where;
    }

    public function index(){
        $data = $this->get_search_where();
        $data['admin_url'] = '/admin/user/get_list?iframe=1';

        $this->view->assign('data',$data);
        if(isset($_GET['iframe']) && $_GET['iframe']==1){
            $this->view->display('admin/user/user_list');
        }else{
            $this->view->display('admin/user/index');
        }

    }

    public function login(){
        $this->view->display('admin/user/login');
    }

    public function get_list(){
        $data = $this->get_search_where();
        $top_menu = $this->admin_menu->get_top_menu($data['level']);
        $this->view->assign('top_menu',$top_menu);
        $this->view->assign('data',$data);
        $this->view->display('admin/user/user_list');
    }

    public function user_info(){
        $this->view->display('admin/user/user_info');
    }

}

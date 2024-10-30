<?php
/**
 *  fiename: fish/User.php$🐘
 *  date: 2024/10/20 20:44:38$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\admin;
use base\exception\LogicException;
use helpers\Input;
use helpers\Session;
use models\curd\AdminGroup;
use models\curd\AdminMenu;
use models\curd\AdminUser;

class  User extends \base\BaseController{

    public $admin_user;
    public $admin_menu;
    public $admin_group;

    public function __construct()
    {
        $this->admin_menu = new AdminMenu();
        $this->admin_user = new AdminUser();
        $this->admin_group = new AdminGroup();
        parent::__construct();
    }

    public function get_search_where(){
        $where['id'] = Input::get_post('id');
        $where['username'] = Input::get_post('username');
        $where['level']    = 0;
        if(isset($_GET['level'])){
            $level = Input::get_post('level',0);
            $where['level'] = intval($level);
        }
        $where = array_filter($where);
        return $where;
    }

    public function welcome(){
        $data = $this->get_search_where();
        $data['admin_url'] = '/admin/user/welcome?iframe=1';

        $this->view->assign('data',$data);
        if(isset($_GET['iframe']) && $_GET['iframe']==1){
            $this->view->display('admin/user/welcome');
        }else{
           $this->view->display('admin/user/index');
        }
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

    public function create(){
        $form['id'] = '';
        $form['username'] = '';
        $form['realname'] = '';
        $form['password'] = '';
        $form['re_password'] = '';
        $form['group_id'] = 0;
        $user_group = $this->admin_group->find_all_group(['group_id'=>$form['group_id']]);
        $this->view->assign('form',$form);
        $this->view->assign('user_group',$user_group);
        $this->view->display('admin/user/create');
    }

    public function update(){
        $form['id'] = Input::get_post('id');
        $user_group = $this->admin_group->find_all_group([]);
        $user = $this->admin_user->info(['id'=>$form['id']]);
        $form = $user;
        $this->view->assign('form',$form);
        $this->view->assign('user_group',$user_group);
        $this->view->display('admin/user/create');
    }

    public function login(){
        $this->view->display('admin/user/login');
    }


    public function get_list(){
        $data = $this->get_search_where();
        $top_menu = $this->admin_menu->get_top_menu(0);
        $this->view->assign('top_menu',$top_menu);
        $this->view->assign('data',$data);
        if(isset($_GET['iframe']) && $_GET['iframe']==1){
            $this->view->display('admin/user/user_list');
        }else{
            $this->view->display('admin/user/index');

        }
    }

    public function edit_permission(){
        $form = $this->get_search_where();
        $menu_data = $this->admin_menu->get_tree_array($form);
        $menu_data = json_encode($menu_data,JSON_UNESCAPED_UNICODE);
        $user_info = $this->admin_user->info(['id'=>$form['id']]);
        $admin_info_mids = array();
        if(isset($user_info['mids']) && !empty($user_info['mids'])){
            $admin_info_mids = explode(',',$user_info['mids']);
        }
        //var_dump($admin_info_mids);
        $this->view->assign('form',$form);
        $this->view->assign('admin_info_mids',json_encode($admin_info_mids));
        $this->view->assign('menu_data',$menu_data);
        $this->view->display('admin/group/edit_permission');
    }

    public function user_info(){
        $form['id'] = Input::get_post('id','','intval');
        $user = $this->admin_user->info(['id'=>$form['id']]);
        $form = $user;
        $this->view->assign('form',$form);
        $this->view->display('admin/user/user_info');
    }

}

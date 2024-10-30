<?php
/**
 *  fiename: fish/User.php$🐘
 *  date: 2024/10/20 20:44:38$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\admin;
use base\exception\LogicException;
use helpers\Input;
use models\curd\AdminGroup;
use models\curd\AdminMenu;
use models\curd\AdminUser;

class  Menu extends \base\BaseController{

    public $admin_menu;
    public $admin_group;
    public $admin_user;

    public function __construct()
    {
        $this->admin_menu = new AdminMenu();
        $this->admin_group = new AdminGroup();
        $this->admin_user = new AdminUser();
        parent::__construct();
    }

    public function get_search_where(){
        $where['id'] = Input::get_post('id');
        $where['parentid'] = Input::get_post('parentid');
        $where['name'] = Input::get_post('name');
        $where['model'] = Input::get_post('model');
        $where['action'] = Input::get_post('action');
        $where['data'] = Input::get_post('data');
        $where['listorder'] = Input::get_post('listorder');
        $where['remark'] = Input::get_post('remark');
        $where['status'] = Input::get_post('status');
        $where = array_filter($where);
        return $where;
    }

    public function index(){
        $form = $this->get_search_where();
        $form['admin_url'] = '/admin/menu/get_list';
        $menu_data = $this->admin_menu->get_tree_array($form);
        $menu_data = json_encode($menu_data,JSON_UNESCAPED_UNICODE);
//        $admin_info = $this->admin_user->info(['id'=>$form['id']]);
//        $admin_info_mids = explode(',',$admin_info['mids']);
        $this->view->assign('form',$form);
//        $this->view->assign('admin_info_mids',json_encode($admin_info_mids));
        $this->view->assign('menu_data',$menu_data);

        $this->view->display('admin/menu/index');
    }

    public function create(){
        $form['id'] = Input::get_post('id');
        $form['parentid'] = Input::get_post('parentid');
        $form['name'] = Input::get_post('name');
        $form['model'] = Input::get_post('model');
        $form['action'] = Input::get_post('action');
        $form['data'] = Input::get_post('data');
        $form['listorder'] = Input::get_post('listorder');
        $form['remark'] = Input::get_post('remark');
        $form['status'] = Input::get_post('status');
        $config_menu = $this->admin_menu->get_config_menu(['id'=>$form['id']]);
        $this->view->assign('form',$form);
        $this->view->assign('config_menu',$config_menu);
        $this->view->display('admin/menu/create');
    }

    public function update(){
        $form['id'] = Input::get_post('id');
        $form['parentid'] = Input::get_post('parentid');
        $form['name'] = Input::get_post('name');
        $form['model'] = Input::get_post('model');
        $form['action'] = Input::get_post('action');
        $form['data'] = Input::get_post('data');
        $form['listorder'] = Input::get_post('listorder');
        $form['remark'] = Input::get_post('remark');
        $form['status'] = Input::get_post('status');
        $config_menu = $this->admin_menu->get_config_menu(['id'=>$form['id']]);
        $menu = $this->admin_menu->info(['id'=>$form['id']]);
        $form = $menu;
        $this->view->assign('form',$form);
        $this->view->assign('config_menu',$config_menu);
        $this->view->display('admin/menu/create');
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

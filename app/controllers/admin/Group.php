<?php
/**
 *  fiename: fish/User.php$🐘
 *  date: 2024/10/20 20:44:38$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\admin;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Session;
use app\helpers\Validate;
use app\models\curd\AdminGroup;
use app\base\BaseController;

class  Group extends BaseController{
    public $admin_group;
    public function __construct()
    {
        $this->admin_group = new AdminGroup();
        parent::__construct();
    }

    public function get_search_where(){
        $where['id'] = Input::get_post('id');
        $where['name'] = Input::get_post('name');
        $where['name'] = trim($where['name']);
        $where['id'] = intval($where['id']);
        $where = array_filter($where);
        $where['mids'] = Input::get_post('mids');

        if(empty($where)){
            $where = '';
        }
        return $where;
    }
    public function index(){
        $data = $this->get_search_where();
        $data['admin_url'] = '/admin/group/get_list?iframe=1';
        $this->view->assign('data',$data);
        $this->view->display('admin/group/index');
//        if(isset($_GET['iframe']) && $_GET['iframe']==1){
//            $this->view->display('admin/group/group_list');
//        }else{
//              $this->view->display('admin/group/index');
//        }

    }

    public function create(){
        $form = [
            'id'=>'',
            'name'=>'',
            'comment'=>'',
            'allow_mutil_login'=>''
        ];
        $this->view->assign('form',$form);
        $this->view->display('admin/group/group_info');
    }

//    public function get_list(){
//        $data = $this->get_search_where();
//        $this->view->assign('data',$data);
//        $this->view->display('admin/group/group_list');
//    }



    public function group_info(){
        $form  = $this->get_search_where();
        $res = $this->admin_group->info($form);
        $this->view->assign('form',$res);
        $this->view->display('admin/group/group_info');
    }



    public function edit_permission(){
        $form = $this->get_search_where();
        $menu_data = $this->admin_menu->get_tree_array($form);
        $menu_data = json_encode($menu_data,JSON_UNESCAPED_UNICODE);
        $group_info = $this->admin_group->info(['id'=>$form['id']]);

        $admin_info_mids = explode(',',$group_info['mids']);
        $this->view->assign('form',$form);
        $this->view->assign('admin_info_mids',json_encode($admin_info_mids));
        $this->view->assign('menu_data',$menu_data);

        $this->view->display('admin/group/edit_permission');
    }

    public function update(){
        $form = $this->get_search_where();
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'管理员不能为空');
        }
        $this->admin_group->save($form);
    }

}

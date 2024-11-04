<?php
/**
 *  fiename: fish/User.php$🐘
 *  date: 2024/10/19 18:56:31$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\api;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\helpers\Debuger;
use app\models\curd\AdminGroup;

use app\base\BaseController;
class Group extends BaseController{
    
    public $admin_group;
    
    public function __construct()
    {
        $this->admin_group = new AdminGroup();
    }


    public function get_search_where(){
        $where['name'] = Input::get_post('name');
        $where['name'] = trim($where['name']);
        $where = array_filter($where);
        if(empty($where)){
            $where = '';
        }
         return $where;
    }

    public function create(){
        $data['id'] = Input::get_post('id');
        $data['name'] = Input::get_post('name');
        $data['comment'] = Input::get_post('comment');
        $data['allow_mutil_login'] =  Input::get_post('allow_mutil_login');
        $data = array_filter($data);
        if(!Validate::required($data['name'])){
            throw  new LogicException(100,'管理员名称不能为空');
        }
        if(!Validate::required($data['comment'])){
            throw  new LogicException(100,'管理员备注不能为空');
        }
        $this->admin_group->create($data);


    }
    public function update(){
        $data['id'] = Input::get_post('id');
        $data['name'] = Input::get_post('name');
        $data['comment'] = Input::get_post('comment');
        $data['allow_mutil_login'] =  Input::get_post('allow_mutil_login');
        if(!Validate::required($data['id'])){
            throw  new LogicException(100,'管理员不能为空');
        }
        if(!Validate::required($data['comment'])){
            throw  new LogicException(100,'管理员备注不能为空');
        }
        $this->admin_group->save($data);
    }
    public function delete(){
        $form['id'] = Input::get_post('id');
        $form['username'] = Input::get_post('username');
        $form['status'] = Input::get_post('status');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'管理员id不能为空');
        }
        if(!Validate::required($form['username'])){
            throw  new LogicException(200,'管理员不能为空');
        }
        $this->admin_group->delete($form);
    }

    public function group_info(){
         $form  = $this->get_search_where();
         $res = $this->admin_group->info($form);
         $this->view->assign('form',$res);
         $this->view->display('admin/group/group_info');
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page');
        $per_page = Input::get_post('per_page');
        list($res,$total) = $this->admin_group->get_list_info($where,$page,$per_page,'*');
        $data['list'] = $res;
        $data['total'] = $total;
        $data['page'] =$page;
        $data['per_page'] = $per_page;
        if($res){
            Input::ajax_return(0,'获取数据成功',$data);
        }else{
            throw new LogicException(100,'没有数据');
        }
    }

    public function edit_permission(){

    }



}

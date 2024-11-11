<?php

namespace app\controllers\im;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\im\Group as M_Group;
use app\helpers\Validate;
class Group extends BaseController{

    public $chat_group  = '';
    public function __construct()
    {
        $this->chat_group = new M_Group();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();

        $id = Input::get_post('id','','intval');
        if($id){
            if(!Validate::required('id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['id'] = $id;
        }

        $account = Input::get_post('account','','trim');
        if($account){
            if(!Validate::required('account')){
                throw  new  LogicException(-1,'群号不能为空');
            }
            $where['account'] = $account;
        }

        $group_name = Input::get_post('group_name','','trim');
        if($group_name){
            if(!Validate::required('group_name')){
                throw  new  LogicException(-1,'群名称不能为空');
            }
            $where['group_name'] = $group_name;
        }

        $status = Input::get_post('status','','trim');
        if($status){
            if(!Validate::required('status')){
                throw  new  LogicException(-1,'状态不能为空');
            }
            $where['status'] = $status;
        }

        $create_time_begin = Input::get_post('create_time_begin','','trim');
        $create_time_end = Input::get_post('create_time_end','','trim');

        if(!empty($create_time_begin)){
            if(!Validate::required('create_time_begin')){
                throw  new  LogicException(-1,'请输入开始时间');
            }
            $where['create_time > '] =strtotime($create_time_begin);
        }
        if(!empty($create_time_end)){
            if(!Validate::required('create_time_end')){
                throw  new  LogicException(-1,'请输入结束时间');
            }
            $where['create_time < '] = strtotime($create_time_end);
        }

        $delete_time_begin = Input::get_post('delete_time_begin','','trim');
        $delete_time_end = Input::get_post('delete_time_end','','trim');

        if(!empty($delete_time_begin)){
            if(!Validate::required('delete_time_begin')){
                throw  new  LogicException(-1,'请输入开始时间');
            }
            $where['delete_time > '] =strtotime($delete_time_begin);
        }
        if(!empty($delete_time_end)){
            if(!Validate::required('delete_time_end')){
                throw  new  LogicException(-1,'请输入结束时间');
            }
            $where['delete_time < '] = strtotime($delete_time_end);
        }

        $where = array_filter($where);
        return $where;
    }

    public function index(){
        $config_status = $this->chat_group->get_config_status();
        $this->view->assign('config_status',$config_status);
        $this->view->display('im/group/index');
    }

    public function create(){
        $form = $this->get_search_where();
        $config_status = $this->chat_group->get_config_status();
        $this->view->assign('form',$form);
        $this->view->assign('config_status',$config_status);
        $this->view->display('im/group/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $form = $this->chat_group->info(['id'=>$form['id']]);
        $config_status = $this->chat_group->get_config_status();
        $this->view->assign('form',$form);
        $this->view->assign('config_status',$config_status);
        $this->view->display('im/group/create');
    }

    public function delete(){

    }

    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('im/group/info');
    }
}
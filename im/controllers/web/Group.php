<?php

namespace im\controllers\web;

use im\base\ImController;
use app\helpers\Input;
use im\models\im\Group as M_Group;
use app\helpers\Validate;
class Group extends ImController{

    public $chat_group  = '';
    public function __construct()
    {
        $this->chat_group = new M_Group();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();

        $id = Input::get_post('id','','trim');
        if($id){
            if(!Validate::required('id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['id'] = $id;
        }

        $account = Input::get_post('account','','trim');
        if($account){
            if(!Validate::required('account')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['account'] = $account;
        }

        $group_name = Input::get_post('group_name','','trim');
        if($group_name){
            if(!Validate::required('group_name')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['group_name'] = $group_name;
        }

        $avatar = Input::get_post('avatar','','trim');
        if($avatar){
            if(!Validate::required('avatar')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['avatar'] = $avatar;
        }

        $belong = Input::get_post('belong','','trim');
        if($belong){
            if(!Validate::required('belong')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['belong'] = $belong;
        }

        $description = Input::get_post('description','','trim');
        if($description){
            if(!Validate::required('description')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['description'] = $description;
        }

        $status = Input::get_post('status','','trim');
        if($status){
            if(!Validate::required('status')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['status'] = $status;
        }

        $start_time = Input::get_post('start_time','','trim');
        $end_time = Input::get_post('end_time','','trim');

        if(!empty($start_time)){
            if(!Validate::required('start_time')){
                throw  new  LogicException(-1,'请输入开始时间');
            }
            $where['start_time > '] =strtotime($start_time);
        }
        if(!empty($end_time)){
            if(!Validate::required('end_time')){
                throw  new  LogicException(-1,'请输入结束时间');
            }
            $where['end_time < '] = strtotime($end_time);
        }

        $update_time = Input::get_post('update_time','','trim');
        if($update_time){
            if(!Validate::required('update_time')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['update_time'] = $update_time;
        }

        $delete_time = Input::get_post('delete_time','','trim');
        if($delete_time){
            if(!Validate::required('delete_time')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['delete_time'] = $delete_time;
        }


        $where = array_filter($where);
        return $where;
    }

    public function index(){
        $form = array(
            'id'=>'',
            'account'=>'',
            'group_name'=>'',
            'avatar'=>'',
            'belong'=>'',
            'description'=>'',
            'status'=>'',
            'create_time'=>'',
            'update_time'=>'',
            'delete_time'=>'',
            'avatar_url'=>''
        );
        $this->view->assign('form',$form);
        $this->view->display('web/group/index');
    }

    public function create(){
        $form = $this->get_search_where();
        $config_status = $this->chat_group->get_config_status();
        $this->view->assign('config_status',$config_status);
        $form = array(
            'id'=>'',
            'account'=>'',
            'group_name'=>'',
            'avatar'=>'',
            'belong'=>'',
            'description'=>'',
            'status'=>'',
            'create_time'=>'',
            'update_time'=>'',
            'delete_time'=>'',
            'avatar_url'=>''
        );
        $this->view->assign('form',$form);
        $this->view->display('web/group/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $form = $this->chat_group->info(['id'=>$form['id']]);
        $config_status = $this->chat_group->get_config_status();
        $this->view->assign('config_status',$config_status);

        $this->view->assign('form',$form);
        $this->view->display('web/group/create');
    }

    public function delete(){

    }

    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('web/group/info');
    }
}
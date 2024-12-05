<?php

namespace im\controllers\web;

use im\base\ImController;
use app\helpers\Input;
use im\models\im\FriendGroup as M_FriendGroup;
use app\helpers\Validate;
class FriendGroup extends ImController{

    public $chat_friend_group  = '';
    public function __construct()
    {
        $this->chat_friend_group = new M_FriendGroup();
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

        $member_id = Input::get_post('member_id','','trim');
        if($member_id){
            if(!Validate::required('member_id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['member_id'] = $member_id;
        }

        $group_name = Input::get_post('group_name','','trim');
        if($group_name){
            if(!Validate::required('group_name')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['group_name'] = $group_name;
        }

        $weight = Input::get_post('weight','','trim');
        if($weight){
            if(!Validate::required('weight')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['weight'] = $weight;
        }

        $create_time = Input::get_post('create_time','','trim');
        if($create_time){
            if(!Validate::required('create_time')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['create_time'] = $create_time;
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

        $status = Input::get_post('status','','trim');
        if($status){
            if(!Validate::required('status')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['status'] = $status;
        }


        $where = array_filter($where);
        return $where;
    }

    public function index(){
        $form = array(
            'id'=>'',
            'member_id'=>'',
            'group_name'=>'',
            'weight'=>'',
            'create_time'=>'',
            'update_time'=>'',
            'delete_time'=>'',
            'status'=>'',
        );
        $this->view->assign('form',$form);
        $this->view->display('web/friend_group/index');
    }

    public function create(){
        $form = $this->get_search_where();
        $form = array(
            'id'=>'',
            'member_id'=>'',
            'group_name'=>'',
            'weight'=>'',
            'create_time'=>'',
            'update_time'=>'',
            'delete_time'=>'',
            'status'=>'',
        );
        $config_status = $this->chat_friend_group->get_config_status();
        $this->view->assign('config_status',$config_status);

        $this->view->assign('form',$form);
        $this->view->display('web/friend_group/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $form = $this->chat_friend_group->info(['id'=>$form['id']]);
        $config_status = $this->chat_friend_group->get_config_status();
        $this->view->assign('config_status',$config_status);

        $this->view->assign('form',$form);
        $this->view->display('web/friend_group/create');
    }

    public function delete(){

    }

    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('web/friend_group/info');
    }
}
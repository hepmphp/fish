<?php

namespace im\controllers\web;

use im\base\ImController;
use im\helpers\Input;
use im\models\im\Friend as M_Friend;
use app\helpers\Validate;
class Friend extends ImController{

    public $chat_friend  = '';
    public function __construct()
    {
        $this->chat_friend = new M_Friend();
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

        $group_id = Input::get_post('group_id','','trim');
        if($group_id){
            if(!Validate::required('group_id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['group_id'] = $group_id;
        }

        $member_id = Input::get_post('member_id','','trim');
        if($member_id){
            if(!Validate::required('member_id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['member_id'] = $member_id;
        }

        $nickname = Input::get_post('nickname','','trim');
        if($nickname){
            if(!Validate::required('nickname')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['nickname'] = $nickname;
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
            'group_id'=>'',
            'member_id'=>'',
            'nickname'=>'',
            'create_time'=>'',
            'update_time'=>'',
            'delete_time'=>'',
            'status'=>'',
        );
        $this->view->assign('form',$form);
        $this->view->display('web/friend/index');
    }

    public function create(){
        $form = $this->get_search_where();
        $form = array(
            'id'=>'',
            'group_id'=>'',
            'member_id'=>'',
            'nickname'=>'',
            'create_time'=>'',
            'update_time'=>'',
            'delete_time'=>'',
            'status'=>'',
        );
        $config_status = $this->chat_friend->get_config_status();
        $this->view->assign('config_status',$config_status);

        $this->view->assign('form',$form);
        $this->view->display('web/friend/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $form = $this->chat_friend->info(['id'=>$form['id']]);
        $config_status = $this->chat_friend->get_config_status();
        $this->view->assign('config_status',$config_status);

        $this->view->assign('form',$form);
        $this->view->display('web/friend/create');
    }

    public function delete(){

    }


    public function find(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('web/friend/find');
    }
    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('web/friend/info');
    }
}
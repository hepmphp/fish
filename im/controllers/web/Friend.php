<?php

namespace im\controllers\web;

use app\helpers\Arr;
use im\base\exception\LogicException;
use im\base\ImController;
use im\helpers\Input;
use im\models\im\Friend as M_Friend;
use im\models\im\Record;
use im\models\im\Member;
use app\helpers\Validate;
class Friend extends ImController{

    public $chat_friend  = '';
    public $chat_record = '';
    public $chat_member = '';
    public function __construct()
    {
        $this->chat_friend = new M_Friend();
        $this->chat_record = new Record();
        $this->chat_member = new Member();
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

        $id = Input::get_post('id','','trim');
        if($id){
            if(!Validate::required('id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['to_id'] = $id;
        }

        $to_id = Input::get_post('to_id','','trim');
        if($to_id){
            if(!Validate::required('to_id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['to_id'] = $to_id;
        }
        $type = Input::get_post('type','','trim');
        if($type){
            if(!Validate::required('type')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['type'] = $type;
        }
        $id = Input::get_post('id','','trim');
        if($id){
            if(!Validate::required('id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['group_id'] = $id;
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
    public function chatlog(){
        $form = $this->get_search_where();
        if($form['type']==='group'){
            if(isset($form['group_id'])){
                $where_sql = " group_id={$form['group_id']} ";
            }
            $page = Input::get_post('page',1,'intval');
            $per_page = Input::get_post('per_page',20,'intval');
            list($res,$total) = $this->chat_record->get_group_list_info($where_sql,$page,$per_page,'*');
            $data['list'] = $res;
            $data['total'] = $total;
            $data['total_page'] = ceil($data['total']/$per_page);
            $data['page'] =$page;
            $data['per_page'] = $per_page;
            $this->view->assign('form',$form);
            $this->view->assign('data',$data);
            $this->view->display('web/friend/group_chatlog');

        }else{
            if(isset($form['to_id'])){
                $where_sql = " (from_id={$form['to_id']} OR to_id={$form['to_id']}) ";
            }
            $page = Input::get_post('page',1,'intval');
            $per_page = Input::get_post('per_page',20,'intval');
            list($res,$total) = $this->chat_record->get_list_info($where_sql,$page,$per_page,'*');
            $data['list'] = $res;
            $data['total'] = $total;
            $data['total_page'] = ceil($data['total']/$per_page);
            $data['page'] =$page;
            $data['per_page'] = $per_page;
            $this->view->assign('form',$form);
            $this->view->assign('data',$data);
            $this->view->display('web/friend/chatlog');

        }

    }
    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('web/friend/info');
    }
}
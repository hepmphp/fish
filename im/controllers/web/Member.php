<?php

namespace im\controllers\web;

use im\base\ImController;
use app\helpers\Input;
use im\models\im\Member as M_Member;
use app\helpers\Validate;
class Member extends ImController{

    public $chat_member  = '';
    public function __construct()
    {
        $this->chat_member = new M_Member();
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

        $socket_id = Input::get_post('socket_id','','trim');
        if($socket_id){
            if(!Validate::required('socket_id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['socket_id'] = $socket_id;
        }

        $username = Input::get_post('username','','trim');
        if($username){
            if(!Validate::required('username')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['username'] = $username;
        }

        $password = Input::get_post('password','','trim');
        if($password){
            if(!Validate::required('password')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['password'] = $password;
        }

        $salt = Input::get_post('salt','','trim');
        if($salt){
            if(!Validate::required('salt')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['salt'] = $salt;
        }

        $nickname = Input::get_post('nickname','','trim');
        if($nickname){
            if(!Validate::required('nickname')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['nickname'] = $nickname;
        }

        $avatar = Input::get_post('avatar','','trim');
        if($avatar){
            if(!Validate::required('avatar')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['avatar'] = $avatar;
        }

        $signature = Input::get_post('signature','','trim');
        if($signature){
            if(!Validate::required('signature')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['signature'] = $signature;
        }

        $status = Input::get_post('status','','trim');
        if($status){
            if(!Validate::required('status')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['status'] = $status;
        }

        $delete_status = Input::get_post('delete_status','','trim');
        if($delete_status){
            if(!Validate::required('delete_status')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['delete_status'] = $delete_status;
        }

        $login_time = Input::get_post('login_time','','trim');
        if($login_time){
            if(!Validate::required('login_time')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['login_time'] = $login_time;
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


        $where = array_filter($where);
        return $where;
    }

    public function index(){
        $form = array(
            'id'=>'',
            'socket_id'=>'',
            'username'=>'',
            'password'=>'',
            'salt'=>'',
            'nickname'=>'',
            'avatar'=>'',
            'signature'=>'',
            'status'=>'',
            'delete_status'=>'',
            'login_time'=>'',
            'create_time'=>'',
            'update_time'=>'',
            'delete_time'=>'',
        );
        $this->view->assign('form',$form);
        $this->view->display('im/chat_member/index');
    }

    public function create(){
        $form = $this->get_search_where();
        $form = array(
            'id'=>'',
            'socket_id'=>'',
            'username'=>'',
            'password'=>'',
            'salt'=>'',
            'nickname'=>'',
            'avatar'=>'',
            'signature'=>'',
            'status'=>'',
            'delete_status'=>'',
            'login_time'=>'',
            'create_time'=>'',
            'update_time'=>'',
            'delete_time'=>'',
        );
        $config_status = $this->chat_member->get_config_status();
        $this->view->assign('config_status',$config_status);
        $config_delete_status = $this->chat_member->get_config_delete_status();
        $this->view->assign('config_delete_status',$config_delete_status);

        $this->view->assign('form',$form);
        $this->view->display('im/chat_member/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $form = $this->chat_member->info(['id'=>$form['id']]);
        $config_status = $this->chat_member->get_config_status();
        $this->view->assign('config_status',$config_status);
        $config_delete_status = $this->chat_member->get_config_delete_status();
        $this->view->assign('config_delete_status',$config_delete_status);

        $this->view->assign('form',$form);
        $this->view->display('im/chat_member/create');
    }

    public function delete(){

    }

    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('im/chat_member/info');
    }
}
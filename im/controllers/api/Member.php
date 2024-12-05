<?php

namespace im\controllers\api;

use im\base\ImController;
use im\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use im\models\im\Member as M_Member;

class Member extends ImController{

    public $chat_member = '';
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

    public function create(){
        $form = $this->get_search_where();
        $this->chat_member->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->chat_member->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->chat_member->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->chat_member->get_list_info($where,$page,$per_page,'*');
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
}
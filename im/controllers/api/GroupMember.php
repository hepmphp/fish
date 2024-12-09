<?php

namespace im\controllers\api;

use im\base\ImController;
use im\base\exception\LogicException;
use im\helpers\Input;
use app\helpers\Validate;
use im\models\im\GroupMember as M_GroupMember;

class GroupMember extends ImController{

    public $chat_group_member = '';
    public function __construct()
    {
        $this->chat_group_member = new M_GroupMember();
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

        $avatar = Input::get_post('avatar','','trim');
        if($avatar){
            if(!Validate::required('avatar')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['avatar'] = $avatar;
        }

        $type = Input::get_post('type','','trim');
        if($type){
            if(!Validate::required('type')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['type'] = $type;
        }

        $forbidden_speech_time = Input::get_post('forbidden_speech_time','','trim');
        if($forbidden_speech_time){
            if(!Validate::required('forbidden_speech_time')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['forbidden_speech_time'] = $forbidden_speech_time;
        }

        $username = Input::get_post('username','','trim');
        if($username){
            if(!Validate::required('username')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['username'] = $username;
        }

        $sign = Input::get_post('sign','','trim');
        if($sign){
            if(!Validate::required('sign')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['sign'] = $sign;
        }

        $nickname = Input::get_post('nickname','','trim');
        if($nickname){
            if(!Validate::required('nickname')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['nickname'] = $nickname;
        }

        $status = Input::get_post('status','','trim');
        if($status){
            if(!Validate::required('status')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['status'] = $status;
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
        $this->chat_group_member->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->chat_group_member->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->chat_group_member->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->chat_group_member->get_list_info($where,$page,$per_page,'*');
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
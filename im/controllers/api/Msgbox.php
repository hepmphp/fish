<?php

namespace im\controllers\api;

use im\base\ImController;
use im\base\exception\LogicException;
use im\helpers\Input;
use app\helpers\Validate;
use im\models\im\Friend;
use im\models\im\Msgbox as M_Msgbox;

class Msgbox extends ImController{

    public $chat_msgbox = '';
    public $friend = '';
    public function __construct()
    {
        $this->friend = new Friend();
        $this->chat_msgbox = new M_Msgbox();
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

        $from_id = Input::get_post('from_id','','trim');
        if($from_id){
            if(!Validate::required('from_id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['from_id'] = $from_id;
        }

        $to_id = Input::get_post('to_id','','trim');
        if($to_id){
            if(!Validate::required('to_id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['to_id'] = $to_id;
        }

        $from_username = Input::get_post('from_username','','trim');
        if($from_username){
            if(!Validate::required('from_username')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['from_username'] = $from_username;
        }

        $to_username = Input::get_post('to_username','','trim');
        if($to_username){
            if(!Validate::required('to_username')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['to_username'] = $to_username;
        }

        $type = Input::get_post('type','','trim');
        if($type){
            if(!Validate::required('type')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['type'] = $type;
        }

        $status = Input::get_post('status','','trim');
        if($status){
            if(!Validate::required('status')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['status'] = $status;
        }

        $remark = Input::get_post('remark','','trim');
        if($remark){
            if(!Validate::required('remark')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['remark'] = $remark;
        }

        $content = Input::get_post('content','','trim');
        if($content){
            if(!Validate::required('content')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['content'] = $content;
        }

        $friend_group_id = Input::get_post('friend_group_id','','trim');
        if($friend_group_id){
            if(!Validate::required('friend_group_id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['friend_group_id'] = $friend_group_id;
        }

        $group_id = Input::get_post('group_id','','trim');
        if($group_id){
            if(!Validate::required('group_id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['group_id'] = $group_id;
        }

        $send_time = Input::get_post('send_time','','trim');
        if($send_time){
            if(!Validate::required('send_time')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['send_time'] = $send_time;
        }

        $read_time = Input::get_post('read_time','','trim');
        if($read_time){
            if(!Validate::required('read_time')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['read_time'] = $read_time;
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
        $this->chat_msgbox->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->chat_msgbox->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->chat_msgbox->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->chat_msgbox->get_list_info($where,$page,$per_page,'*');
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
    public function get_msg_box_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        $data = $this->chat_msgbox->find_all($where,0,1000);
        $data['page'] =$page;
        $data['per_page'] = $per_page;
        $data['pages']= 100;
        if($data){
            Input::ajax_return(0,'获取数据成功',$data);
        }else{
            throw new LogicException(100,'没有数据');
        }
    }

    public function agree_or_refuse(){
        $form['from_id'] = Input::get_post('from_id',0,'intval');
        $form['to_id'] = Input::get_post('to_id',0,'intval');
        $form['status'] = Input::get_post('status',0,'intval');;
        $form['read_time'] = time();
        $form['update_time'] = time();
        $res = $this->chat_msgbox->update($form,['id'=>$form['from_id']],1);
        $form['from_username'] = Input::get_post('from_username','','trim');
        $form['to_username'] = Input::get_post('to_username','','trim');

        $group_id= Input::get_post('group_id',0,'intval');
        $chat_friend_data['group_id'] =$group_id;
        $chat_friend_data['member_id'] = $form['from_id'];
        $chat_friend_data['member_name'] = $form['from_username'];
        $chat_friend_data['friend_id'] = $form['to_id'];
        $chat_friend_data['friend_name'] = $form['to_username'];
        $chat_friend_data['create_time'] = time();

        $res1 = $this->friend->insert($chat_friend_data);
        if($res&&$res1){
            Input::ajax_return(0,'操作成功',$form);
        }else{
            Input::ajax_return(-100,'操作失败',['res'=>$res,'res1'=>$res1]);
        }
    }
}
<?php

namespace im\controllers\web;

use im\base\exception\LogicException;
use im\base\ImController;
use im\helpers\Input;
use im\models\im\Msgbox as M_Msgbox;
use app\helpers\Validate;
use im\models\im\Record;

class Msgbox extends ImController{

    public $chat_msgbox  = '';
    public $chat_record = '';
    public function __construct()
    {
        $this->chat_msgbox = new M_Msgbox();
        $this->chat_record = new Record();
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

    public function index(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->chat_msgbox->get_list_info($where,$page,$per_page,'*');
        $data['list'] = $res;
        $data['total'] = $total;
        $data['total_page'] = ceil($total/$per_page);
        $data['page'] =$page;
        $data['per_page'] = $per_page;
        $form = array(
            'id'=>'',
            'from_id'=>'',
            'to_id'=>'',
            'from_username'=>'',
            'to_username'=>'',
            'type'=>'',
            'status'=>'',
            'remark'=>'',
            'content'=>'',
            'friend_group_id'=>'',
            'group_id'=>'',
            'send_time'=>'',
            'read_time'=>'',
            'create_time'=>'',
            'update_time'=>'',
            'delete_time'=>'',
        );
        $this->view->assign('form',$form);
        $this->view->assign('data',$data);
        $this->view->display('web/msgbox/index');
    }

    public function create(){
        $form = $this->get_search_where();
        $form = array(
            'id'=>'',
            'from_id'=>'',
            'to_id'=>'',
            'from_username'=>'',
            'to_username'=>'',
            'type'=>'',
            'status'=>'',
            'remark'=>'',
            'content'=>'',
            'friend_group_id'=>'',
            'group_id'=>'',
            'send_time'=>'',
            'read_time'=>'',
            'create_time'=>'',
            'update_time'=>'',
            'delete_time'=>'',
        );
        $config_type = $this->chat_msgbox->get_config_type();
        $this->view->assign('config_type',$config_type);
        $config_status = $this->chat_msgbox->get_config_status();
        $this->view->assign('config_status',$config_status);

        $this->view->assign('form',$form);
        $this->view->display('web/msgbox/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $form = $this->chat_msgbox->info(['id'=>$form['id']]);
        $config_type = $this->chat_msgbox->get_config_type();
        $this->view->assign('config_type',$config_type);
        $config_status = $this->chat_msgbox->get_config_status();
        $this->view->assign('config_status',$config_status);

        $this->view->assign('form',$form);
        $this->view->display('web/msgbox/create');
    }

    public function delete(){

    }

    public function invite_group(){
        $chat_msgbox_id = Input::get_post('chat_msgbox_id',0,'intval');
        $record = $this->chat_msgbox->info(['id'=>$chat_msgbox_id]);
        $this->view->assign('form',$record);
        $this->view->display('web/msgbox/invite_group');
    }
    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('web/msgbox/info');
    }
}
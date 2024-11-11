<?php

namespace app\controllers\im;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\im\GroupMember as M_GroupMember;
use app\helpers\Validate;
class GroupMember extends BaseController{

    public $chat_group_member  = '';
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

        $type = Input::get_post('type','','trim');
        if($type){
            if(!Validate::required('type')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['type'] = $type;
        }

        $nickname = Input::get_post('nickname','','trim');
        if($nickname){
            if(!Validate::required('nickname')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['nickname'] = $nickname;
        }

        $status = Input::get_post('status','','trim');
        if(is_numeric($status)){
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


        $where = array_filter($where);
        return $where;
    }

    public function index(){
        $config_type = $this->chat_group_member->get_config_type();
        $config_status = $this->chat_group_member->get_config_status();
        $this->view->assign('config_type',$config_type);
        $this->view->assign('config_status',$config_status);
        $this->view->display('im/group_member/index');
    }

    public function create(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $config_type = $this->chat_group_member->get_config_type();
        $config_status = $this->chat_group_member->get_config_status();
        $this->view->assign('config_type',$config_type);
        $this->view->assign('config_status',$config_status);
        $this->view->display('im/group_member/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $form = $this->chat_group_member->info(['id'=>$form['id']]);
        $config_type = $this->chat_group_member->get_config_type(['id'=>$form['type']]);
        $config_status = $this->chat_group_member->get_config_status(['id'=>$form['status']]);
        $this->view->assign('form',$form);
        $this->view->assign('config_type',$config_type);
        $this->view->assign('config_status',$config_status);
        $this->view->display('im/group_member/create');
    }

    public function delete(){

    }

    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('im/group_member/info');
    }
}
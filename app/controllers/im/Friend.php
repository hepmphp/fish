<?php

namespace app\controllers\im;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\im\Friend as M_Friend;
use app\helpers\Validate;
class Friend extends BaseController{

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

        $status = Input::get_post('status','','trim');
        if(is_numeric($status)){
            $where['status'] = $status;
        }

        $where = array_filter($where);
        return $where;
    }

    public function index(){
        $config_status = $this->chat_friend->get_config_status();
        $this->view->assign('config_status',$config_status);
        $this->view->display('im/friend/index');
    }

    public function create(){
        $form = $this->get_search_where();
        $config_status = $this->chat_friend->get_config_status();
        $this->view->assign('form',$form);
        $this->view->assign('config_status',$config_status);
        $this->view->display('im/friend/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $config_status = $this->chat_friend->get_config_status();
        $form = $this->chat_friend->info(['id'=>$form['id']]);
        $this->view->assign('form',$form);
        $this->view->assign('config_status',$config_status);
        $this->view->display('im/friend/create');
    }

    public function delete(){

    }

    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('im/friend/info');
    }
}
<?php

namespace app\controllers\im;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\models\curd\im\Member as M_Member;
use app\helpers\Validate;
class Member extends BaseController{

    public $chat_member  = '';
    public function __construct()
    {
        $this->chat_member = new M_Member();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();

        $id = Input::get_post('id','','intval');
        if($id){
            if(!Validate::required('id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['id'] = $id;
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

        $create_time_begin = Input::get_post('create_time_begin','','trim');
        $create_time_end = Input::get_post('create_time_end','','trim');

        if(!empty($create_time_begin)){
            if(!Validate::required('create_time_begin')){
                throw  new  LogicException(-1,'请输入开始时间');
            }
            $where['create_time > '] =strtotime($create_time_begin);
        }
        if(!empty($create_time_end)){
            if(!Validate::required('create_time_end')){
                throw  new  LogicException(-1,'请输入结束时间');
            }
            $where['create_time < '] = strtotime($create_time_end);
        }

        $login_time_begin = Input::get_post('login_time_begin','','trim');
        $login_time_end = Input::get_post('login_time_end','','trim');

        if(!empty($login_time_begin)){
            if(!Validate::required('login_time_begin')){
                throw  new  LogicException(-1,'请输入开始时间');
            }
            $where['login_time_begin > '] =strtotime($login_time_begin);
        }
        if(!empty($login_time_end)){
            if(!Validate::required('login_time_end')){
                throw  new  LogicException(-1,'请输入结束时间');
            }
            $where['login_time_end < '] = strtotime($login_time_end);
        }


        $where = array_filter($where);
        return $where;
    }

    public function index(){
        $form = $this->get_search_where();
        $data['admin_url'] = '/im/member/index?iframe=1';
        $this->view->assign('form',$form);
        $this->view->assign('data',$data);
        if(isset($_GET['iframe']) && $_GET['iframe']==1){
            $this->view->display('im/member/index');
        }else{
            $this->view->display('admin/root/admin_iframe');
        }
    }

    public function create(){
        $form = $this->get_search_where();
        $config_status = $this->chat_member->get_config_status();
        $this->view->assign('form',$form);
        $this->view->assign('config_status',$config_status);
        $this->view->display('im/member/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $form = $this->chat_member->info(['id'=>$form['id']]);
        $config_status = $this->chat_member->get_config_status();
        $this->view->assign('form',$form);
        $this->view->assign('config_status',$config_status);
        $this->view->display('im/member/create');
    }

    public function delete(){

    }

    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('im/member/info');
    }
}
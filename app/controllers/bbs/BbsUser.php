<?php

namespace app\controllers\bbs;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\User;

class BbsUser extends BaseController{

    public $user  = '';
    public function __construct()
    {
        $this->user = new User();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();

        $id = Input::get_post('id','','intval,trim');
        if($id){
            if(!Validate::required('id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['id'] = $id;
        }

        $username = Input::get_post('username','','intval,trim');
        if($username){
            if(!Validate::required('username')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['username'] = $username;
        }

        $email = Input::get_post('email','','intval,trim');
        if($email){
            if(!Validate::required('email')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['email'] = $email;
        }

        $status = Input::get_post('status','','intval,trim');
        if($status){
            if(!Validate::required('status')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['status'] = $status;
        }

        $start_time = Input::get_post('start_time','','trim');
        $end_time = Input::get_post('end_time','','trim');

        if(!empty($start_time)){
            if(!Validate::required('start_time')){
                throw  new  LogicException(-1,'请输入开始时间');
            }
            $where['addtime > '] =strtotime($start_time);
        }
        if(!empty($end_time)){
            if(!Validate::required('end_time')){
                throw  new  LogicException(-1,'请输入结束时间');
            }
            $where['addtime < '] = strtotime($end_time);
        }


        $where = array_filter($where);
        return $where;
    }

    public function index(){
        $this->view->display('bbs/user/index');
    }

    public function create(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('bbs/user/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('bbs/user/create');
    }

    public function delete(){

    }

    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('bbs/user/info');
    }
}
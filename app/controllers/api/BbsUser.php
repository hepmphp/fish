<?php

namespace app\controllers\api;
use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\User;

class BbsUser extends BaseController{

    public $user = '';
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

    public function create(){
        $form = $this->get_search_where();
        $this->user->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->user->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->user->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->user->get_list_info($where,$page,$per_page,'*');
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
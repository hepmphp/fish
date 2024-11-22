<?php

namespace app\controllers\api\im;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\im\Group as M_Group;

class Group extends BaseController{

    public $chat_group = '';
    public function __construct()
    {
        $this->chat_group = new M_Group();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();
        $id = Input::get_post('id','','intval');
        if($id){
            if(!Validate::required('id')){
                throw  new  LogicException(-1,'id不能为空');
            }
            $where['id'] = $id;
        }

        $account = Input::get_post('account','','trim');
        if($account){
            if(!Validate::required('account')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['account'] = $account;
        }

        $description = Input::get_post('description','','trim');
        if($description){
            if(!Validate::required('description')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['description'] = $description;
        }

        $status = Input::get_post('status','','trim');
        if(is_numeric($status)){
            $where['status'] = $status;
        }


        $group_name = Input::get_post('group_name','','trim');
        if($group_name){
            if(!Validate::required('group_name')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['group_name'] = $group_name;
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

        //$where = array_filter($where);
        return $where;
    }

    public function create(){
        $form = $this->get_search_where();
        $this->chat_group->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->chat_group->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->chat_group->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->chat_group->get_list_info($where,$page,$per_page,'*');
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
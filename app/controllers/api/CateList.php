<?php

namespace app\controllers\api;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\Posts;

class CateList extends BaseController{

    public $posts = '';
    public function __construct()
    {
        $this->posts = new Posts();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();
        $fid = Input::get_post('fid','','intval,trim');
        if($fid){
            if(!Validate::required('fid')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['fid'] = $fid;
        }

        $pid = Input::get_post('pid','','intval,trim');
        if($pid){
            if(!Validate::required('pid')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['pid'] = $pid;
        }

        $subject = Input::get_post('subject','','intval,trim');
        if($subject){
            if(!Validate::required('subject')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['subject'] = $subject;
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

        $user_id = Input::get_post('user_id','','intval,trim');
        if($user_id){
            if(!Validate::required('user_id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['user_id'] = $user_id;
        }

        $username = Input::get_post('username','','intval,trim');
        if($username){
            if(!Validate::required('username')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['username'] = $username;
        }

        $status = Input::get_post('status','','intval,trim');
        if($status){
            if(!Validate::required('status')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['status'] = $status;
        }


        $where = array_filter($where);
        return $where;
    }

    public function create(){
        $form = $this->get_search_where();
        $this->posts->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->posts->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->posts->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->posts->get_list_info($where,$page,$per_page,'*');
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
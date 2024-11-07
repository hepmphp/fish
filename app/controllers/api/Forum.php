<?php

namespace app\controllers\api;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\Forum as M_Forum;

class Forum extends BaseController{

    public $forum = '';
    public function __construct()
    {
        $this->forum = new M_Forum();
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

        $parentid = Input::get_post('parentid','','intval,trim');
        if($parentid){
            if(!Validate::required('parentid')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['parentid'] = $parentid;
        }

        $name = Input::get_post('name','','trim');
        if($name){
            if(!Validate::required('name')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['name'] = $name;
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

        $status = Input::get_post('status','','intval,trim');
        if($status){
            if(!Validate::required('status')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['status'] = $status;
        }
        $logo = Input::get_post('logo','','trim');
        if($logo){
            if(!Validate::required('logo')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['logo'] = $logo;
        }

        $where = array_filter($where);
        return $where;
    }

    public function create(){
        $form = $this->get_search_where();
        $this->forum->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->forum->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->forum->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->forum->get_list_info($where,$page,$per_page,'*');
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
<?php

namespace app\controllers\api\project;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\project\Project as M_Project;

class Project extends BaseController{

    public $pj_project = '';
    public function __construct()
    {
        $this->pj_project = new M_Project();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();
        $id = Input::get_post('id',0,'intval');
        if(is_numeric($id)){
            if(!Validate::required('id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['id'] = $id;
        }
        $title = Input::get_post('title','','trim');
        if($title){
          if(!Validate::required('title')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['title'] = $title;
        }
            
        $descption = Input::get_post('descption','','trim');
        if($descption){
          if(!Validate::required('descption')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['descption'] = $descption;
        }
            
        $status = Input::get_post('status','','trim');
        if($status){
          if(!Validate::required('status')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['status'] = $status;
        }
            
        $admin_id = Input::get_post('admin_id','','trim');
        if($admin_id){
          if(!Validate::required('admin_id')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['admin_id'] = $admin_id;
        }
            
        $admin_user = Input::get_post('admin_user','','trim');
        if($admin_user){
          if(!Validate::required('admin_user')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['admin_user'] = $admin_user;
        }
            
        $owner_user_id = Input::get_post('owner_user_id','','trim');
        if($owner_user_id){
          if(!Validate::required('owner_user_id')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['owner_user_id'] = $owner_user_id;
        }
            
        $owner_user = Input::get_post('owner_user','','trim');
        if($owner_user){
          if(!Validate::required('owner_user')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['owner_user'] = $owner_user;
        }
            
        $hours = Input::get_post('hours','','trim');
        if($hours){
          if(!Validate::required('hours')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['hours'] = $hours;
        }
            
        $start_date = Input::get_post('start_date','','trim');
        if($start_date){
          if(!Validate::required('start_date')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['start_date'] = strtotime($start_date);
        }
            
        $end_date = Input::get_post('end_date','','trim');
        if($end_date){
          if(!Validate::required('end_date')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['end_date'] = strtotime($end_date);
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

    public function create(){
        $form = $this->get_search_where();
        $this->pj_project->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->pj_project->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->pj_project->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->pj_project->get_list_info($where,$page,$per_page,'*');
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
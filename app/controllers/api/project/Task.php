<?php

namespace app\controllers\api\project;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\project\Task as M_Task;

class Task extends BaseController{

    public $pj_task = '';
    public function __construct()
    {
        $this->pj_task = new M_Task();
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
        $project_id = Input::get_post('project_id',0,'intval');
        if($project_id){
            if(!Validate::required('project_id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['project_id'] = $project_id;
        }
        $title = Input::get_post('title','','trim');
        if($title){
          if(!Validate::required('title')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['title'] = $title;
        }
        $content = Input::get_post('content');
        if($title){
            if(!Validate::required('content')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['content'] = $content;
        }
        $task_color = Input::get_post('task_color','','trim');
        if($title){
            if(!Validate::required('task_color')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['task_color'] = $task_color;
        }

        $priority = Input::get_post('priority','','trim');
        if($priority){
          if(!Validate::required('priority')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['priority'] = $priority;
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
        $this->pj_task->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->pj_task->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->pj_task->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->pj_task->get_list_info($where,$page,$per_page,'*');
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
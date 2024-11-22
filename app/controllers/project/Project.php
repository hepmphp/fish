<?php

namespace app\controllers\project;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\AdminUser;
use app\models\curd\project\Project as M_Project;
use app\helpers\Validate;
 class Project extends BaseController{

     public $pj_project  = '';
     public $admin_user = '';
     public function __construct()
     {
         $this->admin_user = new AdminUser();
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
           $where['start_date'] = $start_date;
        }
            
        $end_date = Input::get_post('end_date','','trim');
        if($end_date){
          if(!Validate::required('end_date')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['end_date'] = $end_date;
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

     public function index()
     {
         $form = $this->get_search_where();
         $config_priority = $this->pj_project->get_config_priority();
         $this->view->assign('config_priority', $config_priority);
         $config_status = $this->pj_project->get_config_status();
         $this->view->assign('config_status', $config_status);

         $this->view->assign('form', $form);
         $this->view->display('project/pj_project/index');

     }

     public function create(){
         $form = $this->get_search_where();


		 $config_priority = $this->pj_project->get_config_priority();
		 $this->view->assign('config_priority',$config_priority);
		 $config_status = $this->pj_project->get_config_status();
		 $this->view->assign('config_status',$config_status);
         $config_admin_user =   $this->admin_user->find_all([],0,1000);
         $this->view->assign('config_admin_user',$config_admin_user);

         $this->view->assign('form',$form);
         $this->view->display('project/pj_project/create');
     }

     public function update(){
         $form = $this->get_search_where();
         $form = $this->pj_project->info(['id'=>$form['id']]);
         $config_admin_user =   $this->admin_user->find_all([],0,1000);
         $config_priority = $this->pj_project->get_config_priority();
         $this->view->assign('config_priority',$config_priority);
         $config_status = $this->pj_project->get_config_status();
         $this->view->assign('config_status',$config_status);
         $this->view->assign('config_admin_user',$config_admin_user);

         $this->view->assign('form',$form);
         $this->view->display('project/pj_project/create');
     }

     public function delete(){

     }

     public function info(){
         $form = $this->get_search_where();
         $this->view->assign('form',$form);
         $this->view->display('project/pj_project/info');
     }
 }
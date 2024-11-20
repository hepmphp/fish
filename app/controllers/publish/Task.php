<?php

namespace app\controllers\publish;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\publish\PublishTask as M_PublishTask;
use app\models\curd\publish\Project;
use app\helpers\Validate;
 class Task extends BaseController{

     public $pub_publish_task  = '';
     public $project= '';
     public function __construct()
     {
         $this->pub_publish_task = new M_PublishTask();
         $this->project = new Project();
         parent::__construct();
     }

    public function get_search_where(){
         $where = array();
        $id = Input::get_post('id','','trim');
        if(is_numeric($id)){
            if(!Validate::required('id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['id'] = $id;
        }
        $admin_id = Input::get_post('admin_id','','trim');
        if($admin_id){
          if(!Validate::required('admin_id')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['admin_id'] = $admin_id;
        }
            
        $deploy_admin_id = Input::get_post('deploy_admin_id','','trim');
        if($deploy_admin_id){
          if(!Validate::required('deploy_admin_id')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['deploy_admin_id'] = $deploy_admin_id;
        }
            
        $project_id = Input::get_post('project_id','','trim');
        if($project_id){
          if(!Validate::required('project_id')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['project_id'] = $project_id;
        }
            
        $project_name = Input::get_post('project_name','','trim');
        if($project_name){
          if(!Validate::required('project_name')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['project_name'] = $project_name;
        }
            
        $status = Input::get_post('status','','trim');
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

     public function index(){
         $config_status = $this->pub_publish_task->get_config_status();
         $this->view->assign('config_status',$config_status);
         $this->view->display('publish/pub_publish_task/index');
     }

     public function create(){
         $form = $this->get_search_where();
		 $config_status = $this->pub_publish_task->get_config_status();
		 $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('publish/pub_publish_task/create');
     }

     public function update(){
         $form = $this->get_search_where();
         $form = $this->pub_publish_task->info(['id'=>$form['id']]);
		 $config_status = $this->pub_publish_task->get_config_status();
		 $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('publish/pub_publish_task/create');
     }

     public function delete(){

     }
     public function apply(){
         $form = $this->get_search_where();
         $form = $this->pub_publish_task->info(['id'=>$form['id']]);
         $project_list = $this->project->find_all([],0,1000);
         $this->view->assign('form',$form);
         $this->view->assign('project_list',$project_list);
         $this->view->display('publish/pub_publish_task/apply');
     }
     public function publish(){
         $form = $this->get_search_where();
         $form = $this->pub_publish_task->info(['id'=>$form['id']]);
         $project_list = $this->project->find_all([],0,1000);
         $project = $this->project->info(['id'=>$form['project_id']]);
         $this->view->assign('form',$form);
         $this->view->assign('project_list',$project_list);
         $this->view->assign('project',$project);
         $this->view->display('publish/pub_publish_task/publish');
     }

     public function rollback(){
         $form = $this->get_search_where();
         $form = $this->pub_publish_task->info(['id'=>$form['id']]);
         $project_list = $this->project->find_all([],0,1000);
         $project = $this->project->info(['id'=>$form['project_id']]);
         $this->view->assign('form',$form);
         $this->view->assign('project_list',$project_list);
         $this->view->assign('project',$project);
         $this->view->display('publish/pub_publish_task/rollback');
     }
     public function info(){
         $form = $this->get_search_where();
         $form = $this->pub_publish_task->info(['id'=>$form['id']]);
         if(file_exists($form['rsync_log_file'])){
             $form['rsync_log_file'] = file_get_contents($form['rsync_log_file']);
         }
         $this->view->assign('form',$form);
         $this->view->display('publish/pub_publish_task/info');
     }

 }
<?php

namespace app\controllers\publish;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\publish\Project as M_Project;
use app\helpers\Validate;
 class Project extends BaseController{

     public $pub_project  = '';
     public function __construct()
     {
         $this->pub_project = new M_Project();
         parent::__construct();
     }

    public function get_search_where(){
         $where = array();
        $id = Input::get_post('id','','intval');
        if(is_numeric($id)){
            if(!Validate::required('admin_id')){
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
            
        $name = Input::get_post('name','','trim');
        if($name){
          if(!Validate::required('name')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['name'] = $name;
        }
            
        $type = Input::get_post('type','','trim');
        if($type){
          if(!Validate::required('type')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['type'] = $type;
        }
            
        $status = Input::get_post('status','','trim');
        if($status){
          if(!Validate::required('status')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['status'] = $status;
        }
            
        $repo_type = Input::get_post('repo_type','','trim');
        if($repo_type){
          if(!Validate::required('repo_type')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['repo_type'] = $repo_type;
        }
            
        $repo_url = Input::get_post('repo_url','','trim');
        if($repo_url){
          if(!Validate::required('repo_url')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['repo_url'] = $repo_url;
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
           

        $where = array_filter($where);
        return $where;
    }

     public function index(){
         $config_type = $this->pub_project->get_config_type();
         $this->view->assign('config_type',$config_type);
         $config_status = $this->pub_project->get_config_status();
         $this->view->assign('config_status',$config_status);
         $data['admin_url'] = '/im/member/index?iframe=1';
         $this->view->assign('data',$data);
         if(isset($_GET['iframe']) && $_GET['iframe']==1){
             $this->view->display('publish/pub_project/index');
         }else{
             $this->view->display('admin/root/admin_iframe');
         }
     }

     public function create(){
         $form = $this->get_search_where();
		 $config_type = $this->pub_project->get_config_type();
		 $this->view->assign('config_type',$config_type);
		 $config_status = $this->pub_project->get_config_status();
		 $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('publish/pub_project/create');
     }
     public function create_user(){
         $form = $this->get_search_where();
         $config_type = $this->pub_project->get_config_type();
         $this->view->assign('config_type',$config_type);
         $config_status = $this->pub_project->get_config_status();
         $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('publish/pub_project/create_user');
     }
     public function update(){
         $form = $this->get_search_where();
         $form = $this->pub_project->info(['id'=>$form['id']]);
		 $config_type = $this->pub_project->get_config_type();
		 $this->view->assign('config_type',$config_type);
		 $config_status = $this->pub_project->get_config_status();
		 $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('publish/pub_project/create');
     }

     public function delete(){

     }

     public function info(){
         $form = $this->get_search_where();
         $this->view->assign('form',$form);
         $this->view->display('publish/pub_project/info');
     }
 }
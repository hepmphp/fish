<?php

namespace app\controllers\publish;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\AdminUser;
use app\models\curd\publish\Project;
use app\models\curd\publish\ProjectMember as M_ProjectMember;
use app\helpers\Validate;
 class ProjectMember extends BaseController{

     public $pub_project_member  = '';
     public $admin_user = '';
     public $project = '';
     public function __construct()
     {
         $this->pub_project_member = new M_ProjectMember();
         $this->admin_user = new AdminUser();
         $this->project = new  Project();
         parent::__construct();
     }

    public function get_search_where(){
         $where = array();
        $id = Input::get_post('id','','intval');
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
            
        $username = Input::get_post('username','','trim');
        if($username){
          if(!Validate::required('username')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['username'] = $username;
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
            

        $where = array_filter($where);
        return $where;
    }

     public function index(){
         $config_admin_id = $this->admin_user->find_all([],0,1000);
         $config_project_id  = $this->project->find_all([],0,1000);
         $config_status = $this->pub_project_member->get_config_status();
         $this->view->assign('config_status',$config_status);
         $this->view->assign('config_admin_id',$config_admin_id);
         $this->view->assign('config_project_id',$config_project_id);
         $this->view->display('publish/pub_project_member/index');
     }

     public function create(){
         $form = $this->get_search_where();

         $this->view->assign('form',$form);
         $this->view->display('publish/pub_project_member/create');
     }

     public function update(){
         $form = $this->get_search_where();
         $config_admin_id = $this->admin_user->find_all([],0,1000);
         $config_project_id  = $this->project->find_all([],0,1000);
         $this->view->assign('config_admin_id',$config_admin_id);
         $this->view->assign('config_project_id',$config_project_id);
         $form = $this->pub_project_member->info(['id'=>$form['id']]);
         $this->view->assign('form',$form);
         $this->view->display('publish/pub_project_member/create');
     }

     public function delete(){

     }

     public function info(){
         $form = $this->get_search_where();
         $this->view->assign('form',$form);
         $this->view->display('publish/pub_project_member/info');
     }
 }
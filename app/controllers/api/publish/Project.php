<?php

namespace app\controllers\api\publish;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\publish\Project as M_Project;

class Project extends BaseController{

    public $pub_project = '';
    public function __construct()
    {
        $this->pub_project = new M_Project();
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

        $repo_username = Input::get_post('repo_username','','trim');
        if($repo_username){
            if(!Validate::required('repo_username')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['repo_username'] = $repo_username;
        }

        $repo_password = Input::get_post('repo_password','','trim');
        if($repo_password){
            if(!Validate::required('repo_password')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['repo_password'] = $repo_password;
        }

        $rsync_local_www = Input::get_post('rsync_local_www','','trim');
        if($rsync_local_www){
            if(!Validate::required('rsync_local_www')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['rsync_local_www'] = $rsync_local_www;
        }

        $rsync_remote_www = Input::get_post('rsync_remote_www','','trim');
        if($rsync_remote_www){
            if(!Validate::required('rsync_remote_www')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['rsync_remote_www'] = $rsync_remote_www;
        }

        $rsync_back_www = Input::get_post('rsync_back_www','','trim');
        if($rsync_back_www){
            if(!Validate::required('rsync_back_www')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['rsync_back_www'] = $rsync_back_www;
        }

        $rsync_user = Input::get_post('rsync_user','','trim');
        if($rsync_user){
            if(!Validate::required('rsync_user')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['rsync_user'] = $rsync_user;
        }
        $rsync_remote_hosts = Input::get_post('rsync_remote_hosts','','trim');
        if($rsync_remote_hosts){
            if(!Validate::required('rsync_remote_hosts')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['rsync_remote_hosts'] = $rsync_remote_hosts;
        }
        $keep_version_num = Input::get_post('keep_version_num','','trim');
        if($keep_version_num){
            if(!Validate::required('keep_version_num')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['keep_version_num'] = $keep_version_num;
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

    public function create(){
        $form = $this->get_search_where();
        $form['admin_id'] = $_SESSION['admin_user_id'];
        $this->pub_project->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->pub_project->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->pub_project->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->pub_project->get_list_info($where,$page,$per_page,'*');
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
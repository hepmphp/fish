<?php

namespace app\controllers\api\publish;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\publish\ProjectMember as M_ProjectMember;

class ProjectMember extends BaseController{

    public $pub_project_member = '';
    public function __construct()
    {
        $this->pub_project_member = new M_ProjectMember();
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
        $status = Input::get_post('status','','trim');
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
        $this->pub_project_member->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->pub_project_member->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->pub_project_member->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->pub_project_member->get_list_info($where,$page,$per_page,'*');
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
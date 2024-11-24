<?php

namespace app\controllers\api\cloud;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\cloud_server\ServerManager as M_ServerManager;

class ServerManager extends BaseController{

    public $cs_server_manager = '';
    public function __construct()
    {
        $this->cs_server_manager = new M_ServerManager();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();
        
        $id = Input::get_post('id','','trim');
        if($id){
          if(!Validate::required('id')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['id'] = $id;
        }
            
        $host = Input::get_post('host','','trim');
        if($host){
          if(!Validate::required('host')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['host'] = $host;
        }
            
        $port = Input::get_post('port','','trim');
        if($port){
          if(!Validate::required('port')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['port'] = $port;
        }
            
        $username = Input::get_post('username','','trim');
        if($username){
          if(!Validate::required('username')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['username'] = $username;
        }
            
        $password = Input::get_post('password','','trim');
        if($password){
          if(!Validate::required('password')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['password'] = $password;
        }
            
        $expire_time = Input::get_post('expire_time','','trim');
        if(!empty($expire_time)){
            if(!Validate::required('expire_time')){
                   throw  new  LogicException(-1,'请输入开始时间');
            }
            $where['expire_time'] =strtotime($expire_time);
        }


        $deltime = Input::get_post('deltime','','trim');
        if($deltime){
          if(!Validate::required('deltime')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['deltime'] = $deltime;
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
        $this->cs_server_manager->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->cs_server_manager->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->cs_server_manager->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->cs_server_manager->get_list_info($where,$page,$per_page,'*');
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
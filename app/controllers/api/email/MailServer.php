<?php

namespace app\controllers\api\email;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\cloud_server\MailServer as M_MailServer;

class MailServer extends BaseController{

    public $cs_mail_server = '';
    public function __construct()
    {
        $this->cs_mail_server = new M_MailServer();
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
            
        $stmp_server = Input::get_post('stmp_server','','trim');
        if($stmp_server){
          if(!Validate::required('stmp_server')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['stmp_server'] = $stmp_server;
        }
            
        $imap_server = Input::get_post('imap_server','','trim');
        if($imap_server){
          if(!Validate::required('imap_server')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['imap_server'] = $imap_server;
        }
            
        $stmp_port = Input::get_post('stmp_port','','trim');
        if($stmp_port){
          if(!Validate::required('stmp_port')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['stmp_port'] = $stmp_port;
        }
            
        $imap_port = Input::get_post('imap_port','','trim');
        if($imap_port){
          if(!Validate::required('imap_port')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['imap_port'] = $imap_port;
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
            
        $addtime = Input::get_post('addtime','','trim');
        if($addtime){
          if(!Validate::required('addtime')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['addtime'] = $addtime;
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
           
        $status = Input::get_post('status','','trim');
        $where['status'] = $status;
        //$where = array_filter($where);
        return $where;
    }

    public function create(){
        $form = $this->get_search_where();
        $this->cs_mail_server->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->cs_mail_server->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->cs_mail_server->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->cs_mail_server->get_list_info($where,$page,$per_page,'*');
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
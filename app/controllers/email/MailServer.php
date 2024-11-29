<?php

namespace app\controllers\email;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\cloud_server\MailServer as M_MailServer;
use app\helpers\Validate;
 class MailServer extends BaseController{

     public $cs_mail_server  = '';
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
        if($status){
          if(!Validate::required('status')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['status'] = $status;
        }
            

        $where = array_filter($where);
        return $where;
    }

     public function index(){
         $this->view->display('email/mail_server/index');
     }

     public function create(){
         $form = $this->get_search_where();
		 $config_status = $this->cs_mail_server->get_config_status();
		 $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('email/mail_server/create');
     }

     public function update(){
         $form = $this->get_search_where();
         $form = $this->cs_mail_server->info(['id'=>$form['id']]);
		 $config_status = $this->cs_mail_server->get_config_status();
		 $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('email/mail_server/create');
     }

     public function delete(){

     }

     public function info(){
         $form = $this->get_search_where();
         $this->view->assign('form',$form);
         $this->view->display('cloud_server/cs_mail_server/info');
     }
 }
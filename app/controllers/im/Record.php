<?php

namespace app\controllers\im;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\im\Record as M_Record;
use app\helpers\Validate;
 class Record extends BaseController{

     public $chat_record  = '';
     public function __construct()
     {
         $this->chat_record = new M_Record();
         parent::__construct();
     }

    public function get_search_where(){
         $where = array();

        $id = Input::get_post('id','','intval');
        if(is_numeric($id)){
            $where['id'] = $id;
        }
        $from_id = Input::get_post('from_id','','trim');
        if(is_numeric($from_id)){
           $where['from_id'] = $from_id;
        }
            
        $to_id = Input::get_post('to_id','','trim');
        if(is_numeric($to_id)){
           $where['to_id'] = $to_id;
        }
            
        $from_username = Input::get_post('from_username','','trim');
        if($from_username){
          if(!Validate::required('from_username')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['from_username'] = $from_username;
        }
            
        $to_username = Input::get_post('to_username','','trim');
        if($to_username){
          if(!Validate::required('to_username')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['to_username'] = $to_username;
        }
            
        $content = Input::get_post('content','','trim');
        if($content){
          if(!Validate::required('content')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['content'] = $content;
        }
            
        $type = Input::get_post('type','','trim');
        if($type){
          if(!Validate::required('type')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['type'] = $type;
        }
            
        $send_time = Input::get_post('send_time','','trim');
        if(is_numeric($send_time)){
           $where['send_time'] = $send_time;
        }
            
        $delete_time = Input::get_post('delete_time','','trim');
        if($delete_time){
          if(!Validate::required('delete_time')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['delete_time'] = $delete_time;
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
         $config_type = $this->chat_record->get_config_type();
         $this->view->assign('config_type',$config_type);
         $config_status = $this->chat_record->get_config_status();
         $this->view->assign('config_status',$config_status);
         $this->view->display('im/record/index');
     }

     public function create(){
         $form = $this->get_search_where();
		 $config_type = $this->chat_record->get_config_type();
		 $this->view->assign('config_type',$config_type);
		 $config_status = $this->chat_record->get_config_status();
		 $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('im/record/create');
     }

     public function update(){
         $form = $this->get_search_where();
         $form = $this->chat_record->info(['id'=>$form['id']]);

		 $config_type = $this->chat_record->get_config_type();
		 $this->view->assign('config_type',$config_type);
		 $config_status = $this->chat_record->get_config_status();
		 $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('im/record/create');
     }

     public function delete(){

     }

     public function info(){
         $form = $this->get_search_where();
         $this->view->assign('form',$form);
         $this->view->display('im/record/info');
     }
 }
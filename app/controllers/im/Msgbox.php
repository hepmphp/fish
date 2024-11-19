<?php

namespace app\controllers\im;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\im\Msgbox as M_Msgbox;
use app\helpers\Validate;
 class Msgbox extends BaseController{

     public $chat_msgbox  = '';
     public function __construct()
     {
         $this->chat_msgbox = new M_Msgbox();
         parent::__construct();
     }

    public function get_search_where(){
         $where = array();
        $id = Input::get_post('id','','intval');
        if(is_numeric($id)){
            $where['id'] = $id;
        }
        $from_id = Input::get_post('from_id','','trim');
        if($from_id){
          if(!Validate::required('from_id')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['from_id'] = $from_id;
        }
            
        $to_id = Input::get_post('to_id','','trim');
        if($to_id){
          if(!Validate::required('to_id')){
               throw  new  LogicException(-1,'链接名称');
           }
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
            
        $content = Input::get_post('content','','trim');
        if($content){
          if(!Validate::required('content')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['content'] = $content;
        }
            
        $group_id = Input::get_post('group_id','','trim');
        if($group_id){
          if(!Validate::required('group_id')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['group_id'] = $group_id;
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
         $config_type = $this->chat_msgbox->get_config_type();
         $this->view->assign('config_type',$config_type);
         $config_status = $this->chat_msgbox->get_config_status();
         $this->view->assign('config_status',$config_status);
         $this->view->display('im/msgbox/index');
     }

     public function create(){
         $form = $this->get_search_where();
		 $config_type = $this->chat_msgbox->get_config_type();
		 $this->view->assign('config_type',$config_type);
		 $config_status = $this->chat_msgbox->get_config_status();
		 $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('im/msgbox/create');
     }

     public function update(){
         $form = $this->get_search_where();
         $form = $this->chat_msgbox->info(['id'=>$form['id']]);
		 $config_type = $this->chat_msgbox->get_config_type();
		 $this->view->assign('config_type',$config_type);
		 $config_status = $this->chat_msgbox->get_config_status();
		 $this->view->assign('config_status',$config_status);

         $this->view->assign('form',$form);
         $this->view->display('im/msgbox/create');
     }

     public function delete(){

     }

     public function info(){
         $form = $this->get_search_where();
         $this->view->assign('form',$form);
         $this->view->display('im/msgbox/info');
     }
 }
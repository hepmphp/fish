<?php

namespace app\controllers\api\im;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\im\Record as M_Record;

class Record extends BaseController{

    public $chat_record = '';
    public function __construct()
    {
        $this->chat_record = new M_Record();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();
        
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

    public function create(){
        $form = $this->get_search_where();
        $this->chat_record->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->chat_record->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->chat_record->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->chat_record->get_list_info($where,$page,$per_page,'*');
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
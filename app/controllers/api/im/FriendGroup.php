<?php

namespace app\controllers\api\im;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\im\FriendGroup as M_FriendGroup;

class FriendGroup extends BaseController{

    public $chat_friend_group = '';
    public function __construct()
    {
        $this->chat_friend_group = new M_FriendGroup();
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
        $member_id = Input::get_post('member_id','','trim');
        if($member_id){
          if(!Validate::required('member_id')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['member_id'] = $member_id;
        }
            
        $group_name = Input::get_post('group_name','','trim');
        if($group_name){
          if(!Validate::required('group_name')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['group_name'] = $group_name;
        }
            
        $weight = Input::get_post('weight','','trim');
        if($weight){
          if(!Validate::required('weight')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['weight'] = $weight;
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
        $this->chat_friend_group->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->chat_friend_group->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->chat_friend_group->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->chat_friend_group->get_list_info($where,$page,$per_page,'*');
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
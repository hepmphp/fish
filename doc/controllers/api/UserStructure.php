<?php

namespace doc\controllers\api;

use doc\base\DocController;
use doc\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use doc\models\doc\UserStructure as M_UserStructure;

class UserStructure extends DocController{

    public $doc_user_structure = '';
    public function __construct()
    {
        $this->doc_user_structure = new M_UserStructure();
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

        $name = Input::get_post('name','','trim');
        if($name){
            if(!Validate::required('name')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['name'] = $name;
        }

        $avator = Input::get_post('avator','','trim');
        if($avator){
            if(!Validate::required('avator')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['avator'] = $avator;
        }

        $parentid = Input::get_post('parentid','','trim');
        if($parentid){
            if(!Validate::required('parentid')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['parentid'] = $parentid;
        }

        $parent_name = Input::get_post('parent_name','','trim');
        if($parent_name){
            if(!Validate::required('parent_name')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['parent_name'] = $parent_name;
        }

        $status = Input::get_post('status','','trim');
        if($status){
            if(!Validate::required('status')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['status'] = $status;
        }

        $title = Input::get_post('title','','trim');
        if($title){
            if(!Validate::required('title')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['title'] = $title;
        }

        $level = Input::get_post('level','','trim');
        if($level){
            if(!Validate::required('level')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['level'] = $level;
        }


        $where = array_filter($where);
        return $where;
    }

    public function create(){
        $form = $this->get_search_where();
        $this->doc_user_structure->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->doc_user_structure->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->doc_user_structure->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',2,'intval');
        list($res,$total) = $this->doc_user_structure->get_list_info($where,$page,$per_page,'*');
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
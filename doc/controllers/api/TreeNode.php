<?php

namespace doc\controllers\api;

use doc\base\DocController;
use doc\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use doc\models\doc\TreeNode as M_TreeNode;

class TreeNode extends DocController{

    public $doc_tree_node = '';
    public function __construct()
    {
        $this->doc_tree_node = new M_TreeNode();
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

        $parentid = Input::get_post('parentid','','trim');
        if($parentid){
            if(!Validate::required('parentid')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['parentid'] = $parentid;
        }

        $level = Input::get_post('level','','trim');
        if($level){
            if(!Validate::required('level')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['level'] = $level;
        }
        $parent_name = Input::get_post('parent_name','','trim');
        if($parent_name){
            if(!Validate::required('parent_name')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['parent_name'] = $parent_name;
        }

        $name = Input::get_post('name','','trim');
        if($name){
            if(!Validate::required('name')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['name'] = $name;
        }

        $logo = Input::get_post('logo','','trim');
        if($logo){
            if(!Validate::required('logo')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['logo'] = $logo;
        }
        $tree_node_id = Input::get_post('tree_node_id','','trim');
        if($tree_node_id){
            if(!Validate::required('tree_node_id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['tree_node_id'] = $tree_node_id;
        }
        $tree_node_name = Input::get_post('tree_node_name','','trim');
        if($tree_node_name){
            if(!Validate::required('tree_node_name')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['tree_node_name'] = $tree_node_name;
        }

        $logo = Input::get_post('logo','','trim');
        if($logo){
            if(!Validate::required('logo')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['logo'] = $logo;
        }

        $created_time = Input::get_post('created_time','','trim');
        if($created_time){
            if(!Validate::required('created_time')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['created_time'] = $created_time;
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
        $this->doc_tree_node->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->doc_tree_node->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->doc_tree_node->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->doc_tree_node->get_list_info($where,$page,$per_page,'*');
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
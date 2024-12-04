<?php

namespace doc\controllers\web;

use doc\base\DocController;
use app\helpers\Input;
use doc\models\doc\UserStructure as M_UserStructure;
use app\helpers\Validate;
class UserStructure extends DocController{

    public $doc_tree_node = '';
    public $doc_user_structure  = '';

    public function __construct()
    {
        $this->doc_tree_node = new \doc\models\doc\TreeNode();
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

        $remark = Input::get_post('remark','','trim');
        if($remark){
            if(!Validate::required('remark')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['remark'] = $remark;
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

    public function index(){
        $form['admin_url'] = '/doc.php/web/user_structure/index?iframe=1';
        $this->view->assign('form',$form);
        if(isset($_GET['iframe']) && $_GET['iframe']==1){
            $this->view->display('doc/web/user_structure/index');
        }else{
            $this->view->display('doc/web/user_structure/index_iframe');
        }

    }

    public function create(){
        $form = $this->get_search_where();
        $config_status = $this->doc_user_structure->get_config_status();
        $this->view->assign('config_status',$config_status);
        if(!isset($form['id'])){
            $form['id'] = 0;
        }
        $form['name'] = '';
        $form['parentid'] = 0;
        $form['parent_name'] = '';
        $form['title'] = '';
        $form['avator_url'] = STATIC_URL.'image/upload_image.png';
        $form['avator'] = '';
        $form['status'] = 0;
        $form['level'] = 0;

        $this->view->assign('form',$form);
        $config_menu = $this->doc_user_structure->get_config_menu(['id'=>$form['id']]);
        $this->view->assign('config_menu',$config_menu);
        $tree_node_config_menu = $this->doc_tree_node->get_config_menu(['id'=>$form['parentid']]);
        $tree_node_config_menu = str_replace('parentid','tree_node_id',$tree_node_config_menu);
        $this->view->assign('tree_node_config_menu',$tree_node_config_menu);
        $this->view->display('doc/web/user_structure/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $form = $this->doc_user_structure->info(['id'=>$form['id']]);
        $config_status = $this->doc_user_structure->get_config_status();
        $this->view->assign('config_status',$config_status);
        $config_menu = $this->doc_user_structure->get_config_menu(['id'=>$form['parentid']]);
        $this->view->assign('config_menu',$config_menu);
        $this->view->assign('form',$form);
        $tree_node_config_menu = $this->doc_tree_node->get_config_menu(['id'=>$form['parentid']]);
        $tree_node_config_menu = str_replace('parentid','tree_node_id',$tree_node_config_menu);
        $this->view->assign('tree_node_config_menu',$tree_node_config_menu);
        $this->view->display('doc/web/user_structure/create');
    }

    public function delete(){

    }

    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('doc/web/user_structure/info');
    }

    public function tree(){
        $tree_list = $this->doc_user_structure->get_tree_array();
        $this->view->assign('tree_list',json_encode($tree_list,JSON_UNESCAPED_UNICODE));
        $this->view->display('doc/web/user_structure/tree');
    }
}
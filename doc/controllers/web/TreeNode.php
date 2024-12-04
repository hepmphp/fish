<?php

namespace doc\controllers\web;

use doc\base\DocController;
use app\helpers\Input;
use doc\models\doc\TreeNode as M_TreeNode;
use app\helpers\Validate;
class TreeNode extends DocController{

    public $doc_tree_node  = '';
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

    public function index(){
        $form['id'] = 0;
        $form['parentid'] = 0;
        $form['level'] = 0;
        $form['name'] = '';
        $form['logo'] = '';
        $form['created_time'] = '';
        $form['status'] = 0;
        $this->view->assign('form',$form);
        $form['admin_url'] = '/doc.php/web/tree_node/index?iframe=1';
        $this->view->assign('form',$form);
        if(isset($_GET['iframe']) && $_GET['iframe']==1){
            $this->view->display('doc/web/tree_node/index');
        }else{
            $this->view->display('doc/web/user_structure/index_iframe');
        }

    }

    public function create(){
        $form = $this->get_search_where();
        $form['id'] = 0;
        $form['parentid'] = 0;
        $form['level'] = 0;
        $form['name'] = '';
        $form['logo'] = '';
        $form['created_time'] = '';
        $form['status'] = 0;
        $form['logo_url'] =  $static_url =  str_replace('doc.php','static/',SITE_URL).'doc/image/upload_image.png';
        $config_menu = $this->doc_tree_node->get_config_menu(['id'=>$form['parentid']]);
        $this->view->assign('config_menu',$config_menu);
        $config_status = $this->doc_tree_node->get_config_status();
        $this->view->assign('config_status',$config_status);

        $this->view->assign('form',$form);
        $this->view->display('doc/web/tree_node/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $form = $this->doc_tree_node->info(['id'=>$form['id']]);
        $config_status = $this->doc_tree_node->get_config_status();
        $this->view->assign('config_status',$config_status);
        $config_menu = $this->doc_tree_node->get_config_menu(['id'=>$form['parentid']]);
        $this->view->assign('config_menu',$config_menu);

        $this->view->assign('form',$form);
        $this->view->display('doc/web/tree_node/create');
    }

    public function delete(){

    }

    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('doc/web/tree_node/info');
    }
}
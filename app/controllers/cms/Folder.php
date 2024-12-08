<?php

namespace app\controllers\cms;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\Folder as M_Folder;
use app\helpers\Validate;
class Folder extends BaseController{

    public $folder  = '';
    public function __construct()
    {
        $this->folder = new M_Folder();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();
        $id = Input::get_post('id','','trim');
        if($id){
            if(!Validate::required('name')){
                throw  new  LogicException(-1,'id不能为空');
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
        //id
        $form = $this->get_search_where();
        $config_status = $this->folder::get_config_status();
        $this->view->assign('form',$form);
        $this->view->assign('config_status',$config_status);
        $this->view->display('cms/folder/index');
    }

    public function create(){
        $form = $this->get_search_where();
        $config_status = $this->folder::get_config_status();
        $select_categorys = $this->folder->get_config_menu('',$form['id']);
        $this->view->assign('form',$form);
        $this->view->assign('config_status',$config_status);
        $this->view->assign('select_categorys',$select_categorys);
        $this->view->display('cms/folder/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $form = $this->folder->info(['id'=>$form['id']]);
        $config_status = $this->folder::get_config_status();
        $select_categorys = $this->folder->get_config_menu('',$form['parentid']);
        $this->view->assign('form',$form);
        $this->view->assign('config_status',$config_status);
        $this->view->assign('select_categorys',$select_categorys);
        $this->view->display('cms/folder/create');
    }

    public function delete(){

    }

    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('cms/folder/info');
    }
}
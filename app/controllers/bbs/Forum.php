<?php

namespace app\controllers\bbs;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\Forum as M_Forum;

class Forum extends BaseController{

    public $forum  = '';
    public function __construct()
    {
        $this->forum = new M_Forum();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();
        $id = Input::get_post('id','','intval,trim');
        if($id){
            if(!Validate::required('id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['id'] = $id;
        }

        $parentid = Input::get_post('parentid','','intval,trim');
        if($parentid){
            if(!Validate::required('parentid')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['parentid'] = $parentid;
        }

        $name = Input::get_post('name','','intval,trim');
        if($name){
            if(!Validate::required('name')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['name'] = $name;
        }

        $start_time = Input::get_post('start_time','','trim');
        $end_time = Input::get_post('end_time','','trim');

        if(!empty($start_time)){
            if(!Validate::required('start_time')){
                throw  new  LogicException(-1,'请输入开始时间');
            }
            $where['addtime > '] =strtotime($start_time);
        }
        if(!empty($end_time)){
            if(!Validate::required('end_time')){
                throw  new  LogicException(-1,'请输入结束时间');
            }
            $where['addtime < '] = strtotime($end_time);
        }

        $status = Input::get_post('status','','intval,trim');
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
        $this->view->display('bbs/forum/index');
    }

    public function create(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $select_tree = $this->forum->get_config_menu([]);
        $config_status = $this->forum::get_config_status();
        $this->view->assign('select_tree',$select_tree);
        $this->view->assign('config_status',$config_status);
        $this->view->display('bbs/forum/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('bbs/forum/create');
    }

    public function delete(){

    }

    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('bbs/forum/info');
    }
}
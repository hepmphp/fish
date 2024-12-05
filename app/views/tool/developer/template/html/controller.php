<?php

namespace app\controllers\[database];

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\[database]\[model] as M_[model];
use app\helpers\Validate;
 class [model] extends BaseController{

     public $[table]  = '';
     public function __construct()
     {
         $this->[table] = new M_[model]();
         parent::__construct();
     }

    public function get_search_where(){
         $where = array();
        [search_where]
        $where = array_filter($where);
        return $where;
    }

     public function index(){
         [config_form]
         $this->view->assign('form',$form);
         $this->view->display('[database]/[table]/index');
     }

     public function create(){
         $form = $this->get_search_where();
         [config_form]
[config_status]
         $this->view->assign('form',$form);
         $this->view->display('[database]/[table]/create');
     }

     public function update(){
         $form = $this->get_search_where();
         $form = $this->[table]->info(['id'=>$form['id']]);
[config_status]
         $this->view->assign('form',$form);
         $this->view->display('[database]/[table]/create');
     }

     public function delete(){

     }

     public function info(){
         $form = $this->get_search_where();
         $this->view->assign('form',$form);
         $this->view->display('[database]/[table]/info');
     }
 }
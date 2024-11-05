<?php

namespace app\controllers\[database];

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\[model];

 class [database] extends BaseController{

     public $[table]  = '';
     public function __construct()
     {
         $this->[table] = new [model]();
         parent::__construct();
     }

    public function get_search_where(){
         $where = array();
        [search_where]
        $where = array_filter($where);
        return $where;
    }

     public function index(){
         $this->view->display('[database]/[table]/index');
     }

     public function create(){
         $form = $this->get_search_where();
         $this->view->assign('form',$form);
         $this->view->display('[database]/[table]/create');
     }

     public function update(){
         $form = $this->get_search_where();
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
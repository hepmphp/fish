<?php

namespace doc\controllers\api;

use doc\base\DocController;
use doc\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use doc\models\doc\File as M_File;

class File extends DocController{

    public $file = '';
    public function __construct()
    {
        $this->file = new M_File();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();

        $id = Input::get_post('id','','trim');
        if($id){
            if(!Validate::required('id')){
                throw  new  LogicException(-1,'id不能为空');
            }
            $where['id'] = $id;
        }

        $folder_id = Input::get_post('folder_id','','trim');
        if(is_numeric($folder_id)){
            if(!Validate::required('folder_id')){
                throw  new  LogicException(-1,'目录id');
            }
            $where['folder_id'] = $folder_id;
        }

        $name = Input::get_post('name','','trim');
        if($name){
            if(!Validate::required('name')){
                throw  new  LogicException(-1,'名称不能为空');
            }
            $where['name'] = $name;
        }

        $folder_name = Input::get_post('folder_name','','trim,strip_tags');
        if($folder_name){
            if(!Validate::required('folder_name')){
                throw  new  LogicException(-1,'名称不能为空');
            }
            $folder_name = str_replace('└ ','',$folder_name);
            $folder_name = str_replace(' ','',$folder_name);
            $where['folder_name'] = $folder_name;
        }

        $file = Input::get_post('file','','trim');
        if($file){
            if(!Validate::required('file')){
                throw  new  LogicException(-1,'文件不能为空');
            }
            $where['file'] = $file;
        }
        $file_lists = Input::get_post('file_lists');
        if($file_lists){
            $where['file_lists'] = $file_lists;
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

       // $where = array_filter($where);
        return $where;
    }

    public function create(){
        $form = $this->get_search_where();

        $this->file->create($form);
    }

    public function update(){
        $form = $this->get_search_where();
        $this->file->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->file->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->file->get_list_info($where,$page,$per_page,'*');
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
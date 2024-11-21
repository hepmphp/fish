<?php

namespace app\controllers\api\cms;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\cms\Collect as M_Collect;

class Collect extends BaseController{

    public $collect = '';
    public function __construct()
    {
        $this->collect = new M_Collect();
        parent::__construct();
    }

    public function get_search_where(){
        $where = array();
        $id = Input::get_post('id',0,'intval');
        if(is_numeric($id)){
            if(!Validate::required('id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['id'] = $id;
        }
        $site = Input::get_post('site','','trim');
        if($site){
          if(!Validate::required('site')){
               throw  new  LogicException(-1,'链接名称');
           }
           $where['site'] = $site;
        }

        $site_url = Input::get_post('site_url','','trim');
        if($site){
            if(!Validate::required('site_url')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['site_url'] = $site_url;
        }

        $list = Input::get_post('list','','trim');
        if($list){
            if(!Validate::required('list')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['list'] = $list;
        }
        $cate = Input::get_post('cate','','trim');
        if($cate){
            if(!Validate::required('cate')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['cate'] = $cate;
        }
        $detail = Input::get_post('detail','','trim');
        if($detail){
            if(!Validate::required('detail')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['detail'] = $detail;
        }

        $preg_list = Input::get_post('preg_list','','');
        if($preg_list){
            if(!Validate::required('preg_list')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['preg_list'] = $preg_list;
        }

        $preg_detail = Input::get_post('preg_detail','','');
        if($preg_detail){
            if(!Validate::required('preg_detail')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['preg_detail'] = $preg_detail;
        }

        $preg_title = Input::get_post('preg_title','','');
        if($preg_title){
            if(!Validate::required('preg_title')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['preg_title'] = $preg_title;
        }

        $preg_author = Input::get_post('preg_author','','');
        if($preg_author){
            if(!Validate::required('preg_author')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['preg_author'] = $preg_author;
        }

        $preg_time = Input::get_post('preg_time','','');
        if($preg_time){
            if(!Validate::required('preg_time')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['preg_time'] = $preg_time;
        }

        $preg_media = Input::get_post('preg_media','','');
        if($preg_media){
            if(!Validate::required('preg_media')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['preg_media'] = $preg_media;
        }

        $preg_content = Input::get_post('preg_content','','');
        if($preg_content){
            if(!Validate::required('preg_content')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['preg_content'] = $preg_content;
        }


        $start_time = Input::get_post('start_time','','trim');
        $end_time = Input::get_post('end_time','','trim');
       
        if(!empty($start_time)){
            if(!Validate::required('start_time')){
                   throw  new  LogicException(-1,'请输入开始时间');
            }
            $where['start_time > '] =strtotime($start_time);
        }
        if(!empty($end_time)){
            if(!Validate::required('end_time')){
                   throw  new  LogicException(-1,'请输入结束时间');
            }
            $where['end_time < '] = strtotime($end_time);
        }
           
        $status = Input::get_post('status','','trim');
        if(is_numeric($status)){
           $where['status'] = $status;
        }
            

        $where = array_filter($where);
        return $where;
    }

    public function create(){
        $form = $this->get_search_where();
        $this->collect->create($form);

    }

    public function update(){
        $form = $this->get_search_where();
        $this->collect->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->collect->delete($form);
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page',1,'intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->collect->get_list_info($where,$page,$per_page,'*');
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
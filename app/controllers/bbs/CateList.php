<?php

namespace app\controllers\bbs;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\Posts;
use app\helpers\Validate;
use app\helpers\SiteUrl;

class CateList extends BaseController{

    public $posts  = '';
    public function __construct()
    {
        $this->posts = new Posts();
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

        $pid = Input::get_post('pid','','intval,trim');
        if($pid){
            if(!Validate::required('pid')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['pid'] = $pid;
        }

        $subject = Input::get_post('subject','','intval,trim');
        if($subject){
            if(!Validate::required('subject')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['subject'] = $subject;
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

        $user_id = Input::get_post('user_id','','intval,trim');
        if($user_id){
            if(!Validate::required('user_id')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['user_id'] = $user_id;
        }

        $username = Input::get_post('username','','intval,trim');
        if($username){
            if(!Validate::required('username')){
                throw  new  LogicException(-1,'链接名称');
            }
            $where['username'] = $username;
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
        $data['admin_url'] = '/bbs/catelist/index?iframe=1';
        $this->view->assign('data',$data);
        if(isset($_GET['iframe']) && $_GET['iframe']==1){
            $this->view->display('bbs/catelist/index');
        }else{
            $this->view->display('admin/root/admin_iframe');
        }
    }

    public function create(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('bbs/catelist/create');
    }

    public function update(){
        $form = $this->get_search_where();
        $form = $this->posts->info(['id'=>$form['id']]);
        $stamp_path = WEB_PATH.'/static/bbs/image/stamp/*';
        $images = glob($stamp_path);
        $options = array();
        $image_list = array();
        foreach ($images as $k=>$image){
            // <option data-img-src="img/adnan.png">Adnan Sagar</option>
            $filename = basename($image);
            $selected  = '';
            if($filename==$form['stamp']){
                $selected = 'selected';

            }
            $url = SiteUrl::get_stamp_url($filename);
            $options[] = "<option value='{$filename}' $selected>{$filename}</option>\n";
            if($k==0){
                $image_list[] = "<img src='{$url}' class='image' value='{$filename}' style='width:90px;height: 90px;' >\n";
            }else{
                $image_list[] = "<img src='{$url}' class='image'  value='{$filename}' style='width:90px;height: 90px;display: none' >\n";
            }
        }
        $this->view->assign('image_list',$image_list);
        $this->view->assign('options',$options);
        $this->view->assign('form',$form);
        $this->view->display('bbs/catelist/create');
    }

    public function delete(){

    }

    public function info(){
        $form = $this->get_search_where();
        $this->view->assign('form',$form);
        $this->view->display('bbs/catelist/info');
    }
}
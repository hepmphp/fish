<?php
/**
 *  fiename: fish/Category.php$🐘
 *  date:  2024/10/29   19:49$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\api;

use base\BaseController;
use base\exception\LogicException;
use helpers\Input;
use helpers\Validate;

use models\curd\Banner as M_Banner;

class Banner extends BaseController{

    public $bannner = '';

    public function __construct()
    {
        $this->bannner = new M_Banner();
        parent::__construct();
    }

    public function get_search_where(){
        $where['name'] = Input::get_post('name','','trim');
        $where = array_filter($where);
        return $where;
    }

    public function create(){

        $form['name'] = Input::get_post('name','','trim');
        $form['domain'] = Input::get_post('domain','','trim');
        $form['image_url'] = Input::get_post('image_url','','trim');
        $form['status']  = Input::get_post('status',0,'intval');
        if(!Validate::required($form['name'])){
            throw  new  LogicException(-1,'链接名称');
        }
        if(!Validate::required($form['image_url'])){
            throw  new  LogicException(-2,'请上传图像');
        }
        $this->bannner->create($form);

    }

    public function update(){
        $form['id'] = Input::get_post('id','','intval');
        $form['name'] = Input::get_post('name','','trim');
        $form['domain'] = Input::get_post('domain','','trim');
        $form['image_url'] = Input::get_post('image_url','','trim');
        $form['status']  = Input::get_post('status',0,'intval');
        if(!Validate::required($form['id'])){
            throw  new  LogicException(-1,'id不能为空');
        }
        if(!Validate::required($form['name'])){
            throw  new  LogicException(-1,'链接名称');
        }
        if(!Validate::required($form['link_address'])){
            throw  new  LogicException(-2,'链接地址');
        }
        $this->bannner->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'id不能为空');
        }
        $this->bannner->delete($form);
    }


    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page');
        $per_page = Input::get_post('per_page',20);
        list($res,$total) = $this->bannner->get_list_info($where,$page,$per_page,'*');
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
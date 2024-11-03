<?php
/**
 *  fiename: fish/Category.php$🐘
 *  date:  2024/10/29   19:49$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\cms;

use base\BaseController;
use helpers\Input;
use models\curd\ArticleCategory as CmsArticleCategory;
use models\curd\Banner as M_Banner;

class Banner extends BaseController{

    public $banner = '';
    public function __construct()
    {
        $this->banner = new M_Banner();
        parent::__construct();
    }


    public function index(){
        $this->view->display('cms/banner/index');
    }

    public function create(){
        $form['id'] = '';
        $form['name'] = '';
        $form['domain'] = '';
        $form['image_url'] = '';
        $form['status']  = 0;
        $this->view->assign('form',$form);
        $this->view->display('cms/banner/create');
    }

    public function update(){
        $form['id'] = Input::get_post('id');
        $form = $this->banner->info(['id'=>$form['id']]);
        $this->view->assign('form',$form);
        $this->view->display('cms/banner/create');
    }

    public function delete(){

    }

    public function info(){
        $id  = Input::get_post('id',0,'intval');
        $res = $this->banner->info(['id'=>$id]);
        $this->view->assign('form',$res);
        $this->view->display('cms/banner/info');
    }
}
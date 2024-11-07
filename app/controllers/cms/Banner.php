<?php
/**
 *  fiename: fish/Category.php$🐘
 *  date:  2024/10/29   19:49$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\cms;

use app\base\BaseController;
use app\helpers\Input;
use app\helpers\SiteUrl;
use app\models\curd\ArticleCategory as CmsArticleCategory;
use app\models\curd\Banner as M_Banner;

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
        if(!empty($form['image_url'])){
            $list_images = explode(',',$form['image_url']);
            $list_image_urls = array();
            foreach ($list_images as $k=>$v){
                $list_image_urls[] = SITE_URL."upload/".$v;
            }
            $form['list_image_url'] = $list_image_urls;
        }
        $this->view->assign('form',$form);
        $this->view->display('cms/banner/create');
    }

    public function delete(){

    }

    public function info(){
        $id  = Input::get_post('id',0,'intval');
        $res = $this->banner->info(['id'=>$id]);
        if(!empty($res['image_url'])){
            $list_images = explode(',',$res['image_url']);
            $list_image_urls = array();
            foreach ($list_images as $k=>$v){
                $list_image_urls[] = SiteUrl::get_image_url($v);
            }
            $res['image_url'] = $list_image_urls[0];
        }
        $this->view->assign('form',$res);
        $this->view->display('cms/banner/info');
    }
}
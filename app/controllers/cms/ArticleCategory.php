<?php
/**
 *  fiename: fish/Category.php$🐘
 *  date:  2024/10/29   19:49$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\cms;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\ArticleCategory as CmsArticleCategory;

class ArticleCategory extends BaseController{

    public $article_category = '';

    public function __construct()
    {
        $this->article_category = new CmsArticleCategory();
        parent::__construct();
    }


    public function index(){
        $this->view->display('cms/article_category/index');
    }

    public function create(){
        $form['id'] = '';
        $form['name'] = '';
        $form['description']  = '';
        $select_tree = $this->article_category->get_config_menu([]);
        $this->view->assign('select_tree',$select_tree);
        $this->view->assign('form',$form);
        $this->view->display('cms/article_category/create');
    }

    public function update(){
        $form['id'] = Input::get_post('id');
        $form = $this->article_category->info(['id'=>$form['id']]);
        $select_tree = $this->article_category->get_config_menu(['id'=>$form['id']]);
        $this->view->assign('select_tree',$select_tree);
        $this->view->assign('form',$form);
        $this->view->display('cms/article_category/create');
    }

    public function delete(){

    }
}
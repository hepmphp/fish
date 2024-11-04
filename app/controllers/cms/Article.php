<?php
/**
 *  fiename: fish/Article.php$🐘
 *  date: 2024/10/25 7:26:15$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\cms;
use app\helpers\Input;
use app\models\curd\Article as AdminArticle;
use app\models\curd\ArticleCategory;
use app\base\BaseController;
class Article extends BaseController{

    public $admin_menu = array();
    public $admin_article = array();
    public $article_category = array();

    public function __construct()
    {
       $this->admin_article = new AdminArticle();
       $this->article_category = new ArticleCategory();
        parent::__construct();
    }

    public function get_search_where(){
        $where['id'] = Input::get_post('id');
        $where['username'] = Input::get_post('username');
        $level = Input::get_post('level',0);
        $where = array_filter($where);
        return $where;
    }


    public function index(){
        $data['admin_url'] = '/cms/article/index?iframe=1';
        $form = $this->get_search_where();
        $this->view->assign('data',$data);
        if(isset($_GET['iframe']) && $_GET['iframe']==1){
            $this->view->display('cms/article/index');
        }else{
            $this->view->display('admin/user/admin_iframe');
        }
    }

    public function create(){
        $form['id'] = '';
        $form['cate_id'] = '';
        $form['tag_ids'] = '';
        $form['title'] = '';
        $form['keywords'] = '';
        $form['description'] = '';
        $form['is_top'] = '';
        $form['list_image_url'] = '';
        $form['status'] = '';
        $form['content'] = '';
        $select_tree = $this->article_category->get_config_menu([]);
        $this->view->assign('select_tree',$select_tree);
        $this->view->assign('form',$form);
        $this->view->display('cms/article/create');
    }

    public function update(){
        $form['id'] = Input::get_post('id');
        $form = $this->admin_article->info(['id'=>$form['id']]);
        $select_tree = $this->article_category->get_config_menu(['id'=>$form['cate_id']]);
        $this->view->assign('select_tree',$select_tree);
        $this->view->assign('form',$form);
        $this->view->display('cms/article/create');
    }
}
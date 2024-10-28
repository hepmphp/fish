<?php
/**
 *  fiename: fish/Article.php$🐘
 *  date: 2024/10/25 7:26:15$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\cms;
use helpers\Input;
use models\curd\AdminGroup;
use models\curd\AdminUser;
use models\curd\Article as AdminArticle;
class Article extends \base\BaseController{

    public $admin_menu = array();
    public $admin_article = array();

    public function __construct()
    {
       $this->admin_article = new AdminArticle();
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
        $form = $this->get_search_where();
        $this->view->display('cms/article/article_index');
    }

    public function create(){
        $form['id'] = '';
        $form['username'] = '';
        $form['realname'] = '';
        $form['password'] = '';
        $form['re_password'] = '';
        $form['group_id'] = 0;
        $this->view->assign('form',$form);
        $this->view->display('cms/article/create');
    }

    public function update(){
        $form['id'] = Input::get_post('id');
        $this->view->display('cms/user/update');
    }



    public function get_list(){
        $data = $this->get_search_where();
        $top_menu = $this->admin_menu->get_top_menu(0);
        $this->view->assign('top_menu',$top_menu);
        $this->view->assign('data',$data);
        if(isset($_GET['iframe']) && $_GET['iframe']==1){
            $this->view->display('admin/user/user_list');
        }else{
            $this->view->display('admin/user/index');

        }
    }



}
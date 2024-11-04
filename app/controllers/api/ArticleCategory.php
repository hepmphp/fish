<?php
/**
 *  fiename: fish/Category.php$🐘
 *  date:  2024/10/29   19:49$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\api;

use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use app\models\curd\ArticleCategory as CmsArticleCategory;

class ArticleCategory extends BaseController{

    public $article_category = '';

    public function __construct()
    {
        $this->article_category = new CmsArticleCategory();
        parent::__construct();
    }

    public function get_search_where(){
        $where['name'] = Input::get_post('name','','trim');
        $where = array_filter($where);
        return $where;
    }

    public function create(){
        $form['parentid'] = Input::get_post('parentid');
        $form['name'] = Input::get_post('name');
        $form['description']  = Input::get_post('description');
        if(!Validate::required($form['name'])){
            throw  new  LogicException(-1,'文章分类不能为空');
        }
        if(!Validate::required($form['description'])){
            throw  new  LogicException(-2,'文章分类描述不能为空');
        }
        $this->article_category->create($form);

    }

    public function update(){
        $form['id'] = Input::get_post('id','','intval');
        $form['parentid'] = Input::get_post('parentid');
        $form['name'] = Input::get_post('name');
        $form['description']  = Input::get_post('description');
        if(!Validate::required($form['id'])){
            throw  new  LogicException(-1,'文章分类id不能为空');
        }
        if(!Validate::required($form['name'])){
            throw  new  LogicException(-2,'文章分类不能为空');
        }
        if(!Validate::required($form['description'])){
            throw  new  LogicException(-3,'文章分类描述不能为空');
        }
        $this->article_category->save($form);
    }

    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'文章id不能为空');
        }
        $this->article_category->delete($form);
    }


    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page');
        $per_page = Input::get_post('per_page',2);
        list($res,$total) = $this->article_category->get_list_info($where,$page,$per_page,'*');
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
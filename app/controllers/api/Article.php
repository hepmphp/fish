<?php
/**
 *  fiename: fish/User.php$🐘
 *  date: 2024/10/19 18:56:31$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\api;
use base\exception\LogicException;
use helpers\Input;
use helpers\Session;
use helpers\Validate;
use models\curd\Article as AdminArticle;


class Article extends \base\BaseController{
    
    public $admin_article;
    
    public function __construct()
    {
        $this->admin_article = new AdminArticle();
    }


    public function get_search_where(){
        $where['id'] = Input::get_post('id','','intval');
        $where['admin'] = Input::get_post('admin','','trim');
        $where['title'] = Input::get_post('title','','trim');
        $start_time = Input::get_post('start_time');
        $end_time = Input::get_post('end_time');
        if(!empty($start_time)){
            $where['create_time>'] =strtotime($start_time);
        }
        if(!empty($end_time)){
            $where['create_time<'] = strtotime($end_time);
        }
        $where = array_filter($where);
        $where['status'] = Input::get_post('status',0);
        if(empty($where)){
            $where = '';
        }
         return $where;
    }

    public function create(){
        $form['cate_id'] = Input::get_post('cate_id');
        $form['tag_ids'] = Input::get_post('tag_ids');
        $form['admin_id'] = Session::get('admin_user_id');
        $form['admin'] =   Session::get('admin_user_username');
        $form['title'] = Input::get_post('title');
        $form['keywords'] = Input::get_post('keywords');
        $form['description'] = Input::get_post('description');
        $form['content'] = Input::get_post('content');
        $form['is_top'] = Input::get_post('is_top');
        $form['list_image_url'] = Input::get_post('list_image_url');
        $form['status'] = Input::get_post('status');

        $form['admin_id']  = intval($form['admin_id'] );
        $form['cate_id']  = intval($form['cate_id'] );
        if(!Validate::required($form['title'])){
            throw  new LogicException(100,'标题不能为空');
        }
        if(!Validate::required($form['content'])){
            throw  new LogicException(200,'内容不能为空');
        }
        $this->admin_article->create($form);
    }
    public function update(){
        $form['id'] = Input::get_post('id');
        $form['cate_id'] = Input::get_post('cate_id');
        $form['tag_ids'] = Input::get_post('tag_ids');
        $form['admin_id'] = Session::get('admin_user_id');
        $form['admin'] =   Session::get('admin_user_username');
        $form['title'] = Input::get_post('title');
        $form['keywords'] = Input::get_post('keywords');
        $form['description'] = Input::get_post('description');
        $form['content'] = Input::get_post('content');
        $form['is_top'] = Input::get_post('is_top');
        $form['list_image_url'] = Input::get_post('list_image_url');
        $form['status'] = Input::get_post('status');
        $form['admin_id']  = intval($form['admin_id'] );
        $form['cate_id']  = intval($form['cate_id'] );
        if(!Validate::required($form['title'])){
            throw  new LogicException(100,'标题不能为空');
        }
        if(!Validate::required($form['content'])){
            throw  new LogicException(200,'内容不能为空');
        }
        $this->admin_article->save($form);
    }
    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'文章id不能为空');
        }
        $this->admin_article->delete($form);
    }

    public function group_info(){
         $form  = $this->get_search_where();
         $res = $this->admin_article->info($form);
         $this->view->assign('form',$res);
         $this->view->display('admin/group/group_info');
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page');
        $per_page = Input::get_post('per_page',2);
        list($res,$total) = $this->admin_article->get_list_info($where,$page,$per_page,'*');
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

    public function edit_permission(){

    }



}

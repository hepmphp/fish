<?php
/**
 *  fiename: fish/Article.php$🐘
 *  date:  2024/11/4   22:48$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace bbs\controllers\web;

use bbs\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use bbs\base\BbsController;
use bbs\models\Forum;
use bbs\models\Posts;

class Ask extends BbsController{
    public $form = '';
    public $posts = '';
    public function __construct()
    {
        $this->form = new Forum();
        $this->posts = new Posts();
        parent::__construct();
    }

    public function index(){
        $config_menu = $this->form->get_config_menu([]);
        $post['id'] = Input::get_post('id',0,'intval');
        $post['subject'] = '';
        $post['content'] = '';
        $post['created_time'] = time();
        $this->view->assign('config_menu',$config_menu);
        $this->view->assign('post',$post);
        $this->view->display('web/ask');
    }

    public function create(){
        $form['fid'] = Input::get_post('fid',0,'intval');
        $form['pid'] = Input::get_post('pid',0,'intval');
        $form['subject'] = Input::get_post('subject','','trim');
        $form['content'] = Input::get_post('content','','trim');

        if(!Validate::required($form['fid'])){
            throw new LogicException(-1,'板块不能为空');
        }

        if(!Validate::required($form['subject'])){
            throw new LogicException(-2,'标题不能为空');
        }
        if(!Validate::required($form['content'])){
            throw new LogicException(-3,'内容不能为空');
        }
        $this->posts->create($form);
    }


    public function update(){
        $form['id'] = Input::get_post('id',0,'intval');

        $post['subject'] = '';
        $post['content'] = '';
        $post['created_time'] = time();
        $config_menu = '';
        if(!empty($form['id'])){
            $post = $this->posts->info(['id'=>$form['id']]);
            $config_menu = $this->forum->get_config_menu(['id'=>$post['fid']]);

        }
        $this->view->assign('config_menu',$config_menu);
        $this->view->assign('post',$post);
        $this->view->display('web/ask');
    }

    public function ajax_update(){
        $form['id'] = Input::get_post('id',0,'intval');
        $post['subject'] = '';
        $post['content'] = '';
        $post['created_time'] = time();
        $config_menu = '';
        if(!empty($form['id'])){
            $post = $this->posts->info(['id'=>$form['id']]);
            $config_menu = $this->forum->get_config_menu(['id'=>$post['fid']]);

        }
        $this->view->assign('config_menu',$config_menu);
        $this->view->assign('post',$post);
        $this->view->display('web/ajax_ask');
    }

    public function ajax_create(){
        $form['pid'] = Input::get_post('id',0,'intval');
        $form['subject'] = '';
        $form['content'] = '';
        $form['created_time'] = time();
        $config_menu = '';
        $config_menu = $this->forum->get_config_menu([]);
        $this->view->assign('config_menu',$config_menu);
        $this->view->assign('form',$form);
        $this->view->display('web/ajax_create');
    }

    public function update_ask(){
        $form['id'] = Input::get_post('id',0,'intval');
        $form['fid'] = Input::get_post('fid',0,'intval');
        $form['subject'] = Input::get_post('subject','','trim');
        $form['content'] = Input::get_post('content','','trim');
        if(!Validate::required($form['id'])){
            throw new LogicException(-1,'id不能为空');
        }
        if(!Validate::required($form['fid'])){
            throw new LogicException(-2,'分类不能为空');
        }
        if(!Validate::required($form['subject'])){
            throw new LogicException(-3,'标题不能为空');
        }
        if(!Validate::required($form['content'])){
            throw new LogicException(-4,'内容不能为空');
        }
        $this->posts->save($form);
    }


    public function see_reply_list(){
        $form['id'] = Input::get_post('id',0,'intval');
        $config_menu = $this->forum->get_config_menu([]);
        $post['subject'] = '';
        $post['content'] = '';
        $post['created_time'] = time();
        $reply['list'] = '';
        if(!empty($form['id'])){
            $post = $this->posts->info(['id'=>$form['id']]);
            $reply = [];
            $where['pid'] = Input::get_post( 'id','0','intval');
            $page = Input::get_post('page','1','intval');
            $per_page = Input::get_post('per_page',20,'intval');
            list($res,$total) = $this->posts->get_list_info($where,$page,$per_page,'*');
            $reply['list'] = $res;
            $reply['total'] = $total;
            $reply['page'] =$page;
            $reply['per_page'] = $per_page;
        }
        $this->view->assign('config_menu',$config_menu);
        $this->view->assign('post',$post);
        $this->view->assign('reply',$reply);
        $this->view->display('web/see_reply_list');

    }

    public function ajax_reply_create(){
        $form['id'] = Input::get_post('id',0,'intval');
        $form['fid'] = Input::get_post('fid',0,'intval');
        $form['subject'] = '';
        $form['content'] = '';
        $form['created_time'] = time();
        $form = $this->posts->info(['id'=>$form['id']]);
        $config_menu = '';
        $config_menu = $this->forum->get_config_menu(['id'=>$form['fid']]);
        $this->view->assign('config_menu',$config_menu);
        $this->view->assign('form',$form);
        $this->view->display('web/ajax_reply_create');
    }



}
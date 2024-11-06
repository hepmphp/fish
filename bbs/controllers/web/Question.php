<?php
/**
 *  fiename: fish/Question.php$🐘
 *  date:  2024/11/4   22:45$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace bbs\controllers\web;

use bbs\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Validate;
use bbs\base\BbsController;
use bbs\models\Forum;
use bbs\models\Posts;

class Question extends BbsController{

    public $forum = '';
    public $posts = '';
    public function __construct()
    {
        $this->forum = new Forum();
        $this->posts = new Posts();
        parent::__construct();
    }

    public function index(){
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
        $this->view->display('web/question');
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
            throw new LogicException(-1,'标题不能为空');
        }
        if(!Validate::required($form['content'])){
            throw new LogicException(-2,'内容不能为空');
        }
        $this->posts->create($form);
    }

}
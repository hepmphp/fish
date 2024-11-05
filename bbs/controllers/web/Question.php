<?php
/**
 *  fiename: fish/Question.php$🐘
 *  date:  2024/11/4   22:45$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace bbs\controllers\web;

use app\helpers\Input;
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
        $post = $this->posts->info(['id'=>$form['id']]);
        $this->view->assign('config_menu',$config_menu);
        $this->view->assign('post',$post);
        $this->view->display('web/question');
    }


}
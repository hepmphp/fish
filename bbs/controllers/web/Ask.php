<?php
/**
 *  fiename: fish/Article.php$🐘
 *  date:  2024/11/4   22:48$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace bbs\controllers\web;

use app\base\exception\LogicException;
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
        $this->view->assign('config_menu',$config_menu);
        $this->view->display('web/ask');
    }

    public function create(){
        $form['pid'] = Input::get_post('pid',0,'intval');
        $form['subject'] = Input::get_post('subject','','trim');
        $form['content'] = Input::get_post('content','','trim');
        if(!Validate::required($form['subject'])){
            throw new LogicException('标题不能为空');
        }
        if(!Validate::required($form['content'])){
            throw new LogicException('内容不能为空');
        }
        $this->posts->create($form);
    }


}
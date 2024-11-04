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
use app\models\curd\FriendLink;

class Friend extends BaseController{

    public $friend_link = '';
    public function __construct()
    {
        $this->friend_link = new FriendLink();
        parent::__construct();
    }


    public function index(){
        $this->view->display('cms/friend/index');
    }

    public function create(){
        $form['id'] = '';
        $form['name'] = '';
        $form['link_address'] = '';
        $form['status']  = 0;
        $this->view->assign('form',$form);
        $this->view->display('cms/friend/create');
    }

    public function update(){
        $form['id'] = Input::get_post('id');
        $form = $this->friend_link->info(['id'=>$form['id']]);
        $this->view->assign('form',$form);
        $this->view->display('cms/friend/create');
    }

    public function delete(){

    }
}
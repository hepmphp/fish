<?php
/**
 *  fiename: fish/BbsList.php$🐘
 *  date:  2024/11/4   22:40$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace bbs\controllers\web;

use app\helpers\Arr;
use app\helpers\Input;
use app\helpers\SiteUrl;
use bbs\base\BbsController;
use bbs\models\Forum;
use bbs\models\Posts;
use bbs\base\exception\LogicException;
use app\helpers\Validate;
class BbsList extends BbsController{

    public $forum = '';
    public $posts = '';
    public function __construct()
    {
        $this->forum = new Forum();
        $this->posts = new Posts();
        parent::__construct();
    }

    public function index(){
        $data = [];
        $form['fid'] = Input::get_post( 'id','0','intval');
        if(!empty($form['fid'])){
            $where = " fid={$form['fid']} and pid=0 ";
        }else{
            $where = " pid=0 ";
        }

        $page = Input::get_post('page','1','intval');
        $per_page = Input::get_post('per_page',20,'intval');
        $per_page = 2;
        list($res,$total) = $this->posts->get_list_info($where,$page,$per_page,'*');


        $data['list'] = $res;
        $data['total'] = $total;
        $data['page'] =$page;
        $data['per_page'] = $per_page;
        $forum_data['name'] = '';
        $forum_data['logo'] = '';
        if(!empty($form['fid'])){
            $forum_data = $this->forum->info(['id'=>$form['fid']]);
        }

        $this->view->assign('forum_data',$forum_data);
        $this->view->assign('data',$data);
        $this->view->display('web/bbslist/index');

    }

    public function create(){
        if(Input::is_ajax()){
            $form['name'] = Input::get_post('name','','trim');
            $form['parentid'] = Input::get_post('parentid','','intval');
            if(!Validate::required($form['name'])){
                throw new LogicException(-1,'帖子分类不能为空');
            }
            $this->forum->create($form);
        }else{
            $config_menu = $this->forum->get_config_menu([]);
            $this->view->assign('config_menu',$config_menu);
            $this->view->display('web/bbslist/create');

        }
    }

    public function list(){

        $data = [];
        $where = [];
        $id = Input::get_post('id',0,'intval');
        if(!isset($_GET['id'])){
            $_GET['id'] = 0;
        }else{
            if(!empty($id)){
                $where['id'] = $id;
            }
        }
        $page = Input::get_post('page','1','intval');
        $per_page = Input::get_post('per_page',20,'intval');
        $per_page = 2;
        list($res,$total) = $this->forum->get_list_info($where,$page,$per_page,'*');

        $data['list'] = $res;
        $data['total'] = $total;
        $data['page'] =$page;
        $data['per_page'] = $per_page;

        $this->view->assign('data',$data);
        $this->view->display('web/bbslist/list');
    }

    public function update_forum()
    {
        if (Input::is_ajax()) {
            $form['id'] = Input::get_post('id', '', 'trim');
            $form['name'] = Input::get_post('name', '', 'trim');
            $form['parentid'] = Input::get_post('parentid', '', 'intval');
            $form['logo'] = Input::get_post('logo', '', 'trim');
            if (!Validate::required($form['id'])) {
                throw new LogicException(-1, '分类id不能为空');
            }
            if (!Validate::required($form['name'])) {
                throw new LogicException(-1, '帖子分类不能为空');
            }
            $this->forum->save($form);
        } else {
            $form['id'] = Input::get_post('id',0,'intval');
            $forum = $this->forum->info(['id'=>$form['id']]);
            $config_menu  = $this->forum->get_config_menu(['id'=>$forum['parentid']]);
            if(!empty($forum['logo'])){
                $list_images = explode(',',$forum['logo']);
                $list_image_urls = array();
                foreach ($list_images as $k=>$v){
                    $list_image_urls[] = SiteUrl::get_image_url($v);
                }
                $forum['list_image_url'] = $list_image_urls;
            }
            $this->view->assign('form',$forum);
            $this->view->assign('config_menu',$config_menu);
            $this->view->display('web/bbslist/update_forum');
        }
    }


}
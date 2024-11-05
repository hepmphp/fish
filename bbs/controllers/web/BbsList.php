<?php
/**
 *  fiename: fish/BbsList.php$🐘
 *  date:  2024/11/4   22:40$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace bbs\controllers\web;

use app\helpers\Input;
use bbs\base\BbsController;
use bbs\models\Forum;
use bbs\models\Posts;

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
        $where['fid'] = Input::get_post( 'id','0','intval');
        $page = Input::get_post('page','1','intval');
        $per_page = Input::get_post('per_page',20,'intval');
        list($res,$total) = $this->posts->get_list_info($where,$page,$per_page,'id,fid,subject,created_time');
        $data['list'] = $res;
        $data['total'] = $total;
        $data['page'] =$page;
        $data['per_page'] = $per_page;
        $forum_data['name'] = '';
        if(!empty($where['fid'])){
            $forum_data = $this->forum->info(['id'=>$where['fid']]);
        }

        $this->view->assign('forum_data',$forum_data);
        $this->view->assign('data',$data);
        $this->view->display('web/bbslist');

    }


}
<?php
/**
 *  fiename: fish/Index.php$🐘
 *  date:  2024/11/2   23:42$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace bbs\controllers\web;

use app\helpers\Input;
use bbs\base\BbsController;
use bbs\models\Forum;

class Index extends BbsController{

    public $forum = array();
    public function __construct()
    {
        $this->forum = new Forum();
        parent::__construct();
    }

    public function index(){
        $page = Input::get_post('page','1','intval');
        $per_page = Input::get_post('per_page',20,'intval');
        $per_page = 2;
        $where = '';
        list($res,$total) = $this->forum->get_list_info($where,$page,$per_page,'*');
        $data['list'] = $res;
        $data['total'] = $total;
        $data['page'] =$page;
        $data['per_page'] = $per_page;
        $this->view->assign('data',$data);
        $this->view->display('web/index/index');
    }


}

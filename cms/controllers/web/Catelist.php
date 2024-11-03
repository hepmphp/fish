<?php
/**
 *  fiename: fish/List.php$🐘
 *  date:  2024/11/2   23:43$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace cms\controllers\web;

use cms\base\CmsController;
use cms\models\Article;

use helpers\Input;

class Catelist extends CmsController{

    public $article =array();
    public function __construct()
    {
        $this->article = new Article();
        parent::__construct();

    }
    public function get_search_where(){
        return [];
    }

    public function index(){
        $data = [];
        $where = $this->get_search_where();
        $where['cate_id'] = Input::get_post( 'id','0','intval');
        $page = Input::get_post('page','1','intval');
        $per_page = Input::get_post('per_page',20,'intval');

        list($res,$total) = $this->article->get_list_info($where,$page,$per_page,'id,cate_id,title,addtime');

        $data['list'] = $res;
        $data['total'] = $total;
        $data['page'] =$page;
        $data['per_page'] = $per_page;

        $this->view->assign('data',$data);
        $this->view->display('cms/web/list');
    }

    public function test(){
        echo __CLASS__;
    }
}

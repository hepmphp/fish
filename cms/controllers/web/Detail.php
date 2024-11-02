<?php
/**
 *  fiename: fish/Detail.php$🐘
 *  date:  2024/11/2   23:43$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace cms\controllers\web;

use cms\base\CmsController;
use cms\models\Article;
use helpers\Input;


class Detail extends CmsController{

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
        $where['id'] = Input::get_post( 'id');
        $data = $this->article->info($where);
        $this->view->assign('data',$data);
        $this->view->display('cms/web/detail');
    }
}
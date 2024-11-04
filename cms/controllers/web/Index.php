<?php
/**
 *  fiename: fish/Index.php$🐘
 *  date:  2024/11/2   23:42$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace cms\controllers\web;

use cms\base\CmsController;
use cms\models\Article;
use cms\models\ArticleCategory;
use cms\models\Banner;
use app\helpers\Arr;


class Index extends CmsController{

    public $article = '';
    public $article_category = '';
    public $banner = '';
    public function __construct()
    {
        $this->article = new Article();
        $this->article_category = new ArticleCategory();
        $this->banner = new Banner();
        parent::__construct();

    }

    public function index(){
        $data = [];
        $data1 = $this->article->find_all(" cate_id=2 or FIND_IN_SET('2','cate_bids')",1,10,'id,title,addtime');
        //select * from cms_article_category where ;
        $where_mids = '(1,2,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80)';
        $list = $this->article->find_all("cate_id in {$where_mids}",1,1000,'id,title,addtime,cate_id,cate_name');

        //导航分类
        $article_categorys = $this->article_category->find_all('',1,1000);
        $article_categorys_index = Arr::index($article_categorys,'id');
        $list_format = array();
        $list_format_v = [];
        foreach ($list as $k=>$v){
            if(isset($article_categorys_index[$v['cate_id']])){
                $v['cate_name'] = $article_categorys_index[$v['cate_id']]['name'];
            }
            if(!isset($list_format_v[$v['cate_id']])){
                $list_format_v[$v['cate_id']] = [];
            }
            $list_format[$v['cate_id']][]= $v;
        }
        foreach ($list_format as $k=>$v){
            $list_format[$k] = array_slice($list_format[$k],0,10);
        }

        $banner = $this->banner->find_all(['status'=>0],1,10,'id,name,image_url');

        $this->view->assign('data1',$data1);
        $this->view->assign('list_format',$list_format);
        $this->view->assign('banner',$banner);
        $this->view->display('web/index');

    }


}

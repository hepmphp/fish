<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace cms\models;

use base\Model;
use helpers\Arr;


class Article extends Model
{
    public  $db ='cms';
    public  $table='cms_article';
    public  $db_prefix='';

    public $article_category = array();

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        $this->article_category = new ArticleCategory();
        parent::__construct();
    }


    public function info($data){
        $article = $this->find(['id'=>$data['id']],'*');
        return $article;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 2, $fields = '*')
    {
        $total = $this->get_total($where);
        $articles = $this->get_list($where,$limit,$offset,$fields);

        $article_categorys = $this->article_category->find_all('',1,1000);
        $article_categorys_index = Arr::index($article_categorys,'id');
        foreach ($articles as $k=>$article){
            $articles[$k]['cate_name'] = isset($article_categorys_index[$article['cate_id']])?$article_categorys_index[$article['cate_id']]['name']:'';
            $articles[$k]['addtime_name'] = date('Y-m-d H:i:s',$article['addtime']);
        }

        return [$articles,$total['total']];
    }



}

##生成时间:2024-10-19 10:52:58 文件路径：E:\data\www\fish\web/../app//models/curd/Article.php🐘
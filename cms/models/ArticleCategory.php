<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace cms\models;
use base\exception\LogicException;
use base\Model;
use helpers\Arr;
use helpers\Tree;

class ArticleCategory extends Model
{
    public $db ='cms';
    public  $table='cms_article_category';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }

    public function get_menus(){
        $where = ' level in(0,1,2) ';
        $menus = $this->find_all($where,0,1000);
        $children = array();
        $data = array();
        foreach ($menus as $k=>$menu){
            if($menu['level']==1){
                $children[] = $menu;
            }else{
                $data[] = $menu;
            }

        }

        return [$data,$children];
    }



    public function info($data){
        $article_category = $this->find(['id'=>$data['id']],'*');
        return $article_category;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 2, $fields = '*')
    {
        $total = $this->get_total($where);
        $article_categorys = $this->get_list($where, $limit, $offset, $fields);
        foreach ($article_categorys as $k=>$category){
            $article_categorys[$k]['addtime_name'] = date('Y-m-d H:i:s',$category['addtime']);
        }
        return [$article_categorys,$total['total']];
    }
}

##生成时间:2024-10-19 10:52:58 文件路径：E:\data\www\fish\web/../app//models/curd/ArticleCategory.php🐘
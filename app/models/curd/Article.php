<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace models\curd;
use base\exception\LogicException;
use base\Model;
use helpers\Arr;
use models\curd\ArticleCategory;

class Article extends Model
{
    public  $table='cms_article';
    public  $db_prefix='';

    public $article_category = array();

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        $this->article_category = new ArticleCategory();
        parent::__construct();
    }


    public function create($data){
        $data['addtime'] = time();
        $res = $this->insert($data);
        if($res){
            throw new LogicException(0,'文章添加成功');
        }else{
            throw new LogicException(-1,'文章添加失败');
        }
    }

    public function save($data)
    {
        $res = $this->update($data,['id'=>$data['id']],1);
        if($res){
            throw new LogicException(0,'文章保存成功');
        }else{
            throw new LogicException(-1,'文章保存失败');
        }
    }

    public function delete($form){
        $form['update_time'] = time();
        $form['status'] = -1;
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'文章删除成功');
        }else{
            throw new LogicException(-1,'文章删除失败');
        }
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
            $articles[$k]['status_name'] = $article['status']==-1?'<span class="label btn-danger" style="background-color: red;" >删除</span>':'正常';
            // 0普通 1置顶 2头条
            if($article['is_top']==-0){
                $articles[$k]['is_top_name'] = '<span class="label btn-danger" style="background-color: yellowgreen;" >普通</span>';
            }elseif($article['is_top']==1){
                $articles[$k]['is_top_name'] = '<span class="label btn-success" style="background-color: blue;" >头条</span>';

            }else{
                $articles[$k]['is_top_name'] = '<span class="label btn-success" style="background-color: green;" >置顶 </span>';
            }




        }
        return [$articles,$total['total']];
    }



}

##生成时间:2024-10-19 10:52:58 文件路径：E:\data\www\fish\web/../app//models/curd/Article.php🐘
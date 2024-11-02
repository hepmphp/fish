<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace models\curd;
use base\exception\LogicException;
use base\Model;
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

    public function create($form){
        $form['addtime'] = time();
        $form['status'] = 0;

        //level
        $cate_parent = $this->find(['id'=>$form['parentid']]);
        $form['level'] = isset($cate_parent['level'])?$cate_parent['level']+1:0;
        $res = $this->insert($form);
        if($res){
            throw  new LogicException(0,'文章分类添加成功');
        }else{
            throw  new LogicException(-1,'文章分类添加失败');
        }
    }
    public function save($form){
        $form['status'] = 0;
        //level
        $cate_parent = $this->find(['id'=>$form['parentid']]);
        $form['level'] = isset($cate_parent['level'])?$cate_parent['level']+1:0;
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'文章分类修改成功');
        }else{
            throw new LogicException(-1,'文章分类修改失败');
        }
    }


    public function delete($form){
        $form['status'] = -1;
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'文章分类删除成功');
        }else{
            throw new LogicException(-1,'文章分类删除失败');
        }
    }
    /**
     * 获取菜单配置
     * @param null $parentid
     * @param null $app_id
     * @return mixed
     */
    public function get_config_menu($form){
        $tree = new Tree();
        $where = array();

        if(!empty($form['parentid'])){
            $where['parentid'] = $form['parentid'];
        }
        if(!empty($form['level'])){
            $where['level>'] = $form['level'];
        }
        $admin_menu = $this->find_all($where,1,10000);
        $array = array();
        foreach ($admin_menu as $r) {
            if(isset($form['id']) && $form['id'] !=null){
                $r['selected'] = $r['id'] == $form['id'] ? 'selected' : '';
            }else{
                $r['selected'] = '';
            }

            $array[] = $r;
        }

        $select_categorys = '';
        if(!empty($array)){
            $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
            $tree->init($array);
            $select_categorys = $tree->get_tree(0 , $str);

        }

        return $select_categorys;
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
            // label-success  label-info
            if($category['level']==0){
                $css = 'label-success';
            }else if($category['level']==1){
                $css = 'label-primary';
                $style = 'background:#4876FF';
            }else{
                $css = 'label-info';
            }
            $level = '<span class="label '.$css.'" style="'.$style.'">'.$category["level"].'级菜单</span>';
            $article_categorys[$k]['level'] = $level;
            $article_categorys[$k]['status_name'] = $category['status']==0? '<span class="label btn-success" style="background-color: blue;" >正常</span>':'<span class="label btn-danger" style="background-color: red;" >删除</span>';
            $article_categorys[$k]['addtime_name'] = date('Y-m-d H:i:s',$category['addtime']);
        }
        return [$article_categorys,$total['total']];
    }


}

##生成时间:2024-10-19 10:52:58 文件路径：E:\data\www\fish\web/../app//models/curd/ArticleCategory.php🐘
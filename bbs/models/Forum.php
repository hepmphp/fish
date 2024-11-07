<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace bbs\models;
use app\helpers\Arr;
use bbs\base\Model;
use bbs\base\exception\LogicException;
use app\helpers\Tree;

class Forum extends Model
{
    public  $db ='bbs';
    public  $table='bbs_forum';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }

    public static function get_config_status(){
        return [
            0=>['id'=>0,'name'=>'正常'],
            -1=>['id'=>-1,'name'=>'隐藏'],

        ];
    }
    public function create($form){
        $cate_parent = $this->find(['id'=>$form['parentid']]);
        $form['level'] = isset($cate_parent['level'])?$cate_parent['level']+1:0;
        $form['created_time'] = time();
        $res = $this->insert($form);
        if($res){
            throw  new LogicException(0,'分类添加成功');
        }else{
            throw  new LogicException(-1,'分类添加失败');
        }
    }
    public function save($form){
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'分类修改成功');
        }else{
            throw new LogicException(-1,'分类修改失败');
        }
    }

    public function delete($form){
        $form['status'] = -1;
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'删除成功');
        }else{
            throw new LogicException(-1,'删除成功');
        }
    }

    public function info($data){
        $info = $this->find(['id'=>$data['id']],'*');
        return $info;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 20, $fields = '*')
    {
        $total = $this->get_total($where);
        $data = $this->get_list($where, $limit, $offset, $fields);

        return [$data,$total['total']];
    }

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
            } else{
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

}#end

##生成时间:2024-11-05 23:54:12 文件路径：Forum.php🐘
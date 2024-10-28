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

class AdminMenu extends Model
{
    public  $table='ga_admin_menu';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }

    public function get_top_menu($level=0){
        $where['level'] = $level;
        $limit =1;
        $offset=100;
        $fields ='*';
        $menu = $this->get_list($where,$limit,$offset,$fields);
        return $menu;
    }

    public function get_left_menu(){
        $where = " level in(1,2) and action='index' ";
        $limit =1;
        $offset=100;
        $fields ='*';
        $menu = $this->get_list($where,$limit,$offset,$fields);
        $data  = array();
        $children = array();
        foreach ($menu as $k=>$v){
            if($v['level']==2){
                $children[] =array(
                    'name'=>$v['name'],
                    'id'=>$v['id'],
                    'parentid'=>$v['parentid'],
                    'level'=>'level',
                    'model'=>$v['model'],
                    'action'=>$v['action']
                );
            }else{
                $data[] = array(
                    'name'=>$v['name'],
                    'id'=>$v['id'],
                    'parentid'=>$v['parentid'],
                    'level'=>'level',
                    'model'=>$v['model'],
                    'action'=>$v['action']
                );
            }
        }
        return [$data,$children];
    }

    /**
     * 获取菜单数据
     * @param $where
     * @return array
     */
    public function get_menu_data($where){
        if(isset($where['id'])){
            unset($where['id']);
        }
        $data = $this->find_all($where,1,10000);
        $menu_data = array();
        foreach($data as $k=>$v){
            $menu = array(
                'id'=>$v['id'],
                'pId'=>$v['parentid'],
                'name'=>$v['name'],
            );
            /*
            if($v['parentid']==0){
                $menu['open'] = true;
            }*/
            $menu_data[] = $menu;
        }
        return $menu_data;
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

        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $select_categorys = $tree->get_tree(0 , $str);
        return $select_categorys;
    }
    /***
     *
     * 获取树形菜单
     * @param null $parentid
     * @return Tree
     */
    public function get_menu_tree($parentid=null){
        $tree = new Tree();
        $admin_menu = $this->find_all('',1,10000);
        foreach ($admin_menu as $r) {
            if($parentid !=null){
                $r['selected'] = $r['id'] == $parentid ? 'selected' : '';
            }else{
                $r['selected'] = '';
            }

            $array[] = $r;
        }
        $tree->init($array);
        return $tree;
    }

    public function get_tree_array($parentid=null){
        $tree = new Tree();
        $admin_menu = $this->find_all('',1,10000);
        $tree->init($admin_menu);
        $res = $tree->get_tree_array(0);
        $reform_res = [];
        foreach ($res as $k=>$v){
            $reform_res[] = $v;
        }
        return $admin_menu;
    }


    public function create($data){
        if(isset($data['id'])){
            unset($data['id']);
        }
        $menu_parent = $this->find(['parentid'=>$data['parentid']]);
        $data['level'] = isset($menu_parent['level'])?$menu_parent['level']+1:0;
        $res = $this->insert($data);
        if($res){
            throw new LogicException(0,'菜单添加成功');
        }else{
            throw new LogicException(-1,'菜单添加失败');
        }
    }

    public function save($data)
    {
        $menu_parent = $this->find(['parentid'=>$data['parentid']]);
        $data['level'] = isset($menu_parent['level'])?$menu_parent['level']+1:0;
        $res = $this->update($data,['id'=>$data['id']]);
        if($res){
            throw new LogicException(0,'菜单修改成功');
        }else{
            throw new LogicException(-1,'菜单修改失败');
        }
    }

    public function delete($data){
        $data['status'] = -1;
        $res = $this->update($data,['id'=>$data['id']]);
        if($res){
            throw new LogicException(0,'菜单删除成功');
        }else{
            throw new LogicException(-1,'菜单删除失败');
        }
    }

    public function info($data){
        $menu = $this->find($data,'*');
        return $menu;
    }




}

##生成时间:2024-10-19 10:52:59 文件路径：E:\data\www\fish\web/../app//models/curd/AdminMenu.php🐘
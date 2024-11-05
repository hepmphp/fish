<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\models\curd;
use app\base\exception\LogicException;
use app\base\Model;
use app\base\Url;
use app\helpers\Arr;
use app\helpers\Tree;

class AdminMenu extends Model
{
    public  $table='admin_menu';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }

    public function get_top_menu($where=array(),$level=0){

      //  $where['level'] = $level;
        $limit =1;
        $offset=100;
        $fields ='*';
        $menu = $this->get_list($where,$limit,$offset,$fields,'listorder asc');
        return $menu;
    }

    public function get_left_menu($cate){
        $where = " level in(1,2) and (action='index' OR action='welcome') and status=0 ";
        $limit =1;
        $offset=100;
        $fields ='*';
        $menu = $this->get_list($where,$limit,$offset,$fields,'listorder asc');
        $data  = array();
        $children = array();

        $admin = [
            'admin/menu',
            'admin/user',
            'admin/group',
        ];

        $cms = [
            'cms/article_category',
            'cms/article',
            'cms/tag',
            'cms/attach',
            'cms/banner',
            'cms/friend',

        ];
        $tool = [
            'tool/developer',
            'tool/file',
            'tool/mysql',
            'tool/log',
            'tool/redis'
        ];

        $bbs = [
            'bbs/forum',
            'bbs/cate_list',
            'bbs/user',
        ];

        foreach ($menu as $k=>$v){
                if($cate=='admin' && !in_array($v['model'],$admin)){
                    continue;
                }
                if($cate=='cms' && !in_array($v['model'],$cms)){
                    continue;
                }
                if($cate=='tool' && !in_array($v['model'],$tool)){
                    continue;
                }
                if($cate=='bbs' && !in_array($v['model'],$bbs)){
                    continue;
                }

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
       // $tree = new Tree();
        $admin_menu = $this->find_all('',1,10000);
//        $tree->init($admin_menu);
//        $res = $tree->get_tree_array(0);
//        $reform_res = [];
//        foreach ($res as $k=>$v){
//            $reform_res[] = $v;
//        }
        return $admin_menu;
    }


    public function create($data){
        if(isset($data['id'])){
            unset($data['id']);
        }

        $menu_parent = $this->find(['id'=>$data['parentid']]);
        $data['level'] = isset($menu_parent['level'])?$menu_parent['level']+1:0;
        $insert_id = $this->insert($data);
        $res = $this->update(['top_menu_id'=>$menu_parent['top_menu_id']],['id'=>$insert_id]);
        if($res){
            throw new LogicException(0,'菜单添加成功');
        }else{
            throw new LogicException(-1,'菜单添加失败');
        }
    }

    public function save($data)
    {
        $menu_parent = $this->find(['id'=>$data['parentid']]);
        $data['level'] = isset($menu_parent['level'])?$menu_parent['level']+1:0;
        $data['top_menu_id'] = $data['id'];
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


    public function get_top_left_menu($routers){
        $menu_id_arr = isset($_SESSION['admin_user_mids'])?$_SESSION['admin_user_mids']:0;
        $admin_menu_where['level'] = 0;
        $admin_menu_where['status'] = 0;
        if(!empty($menu_id_arr)){
            $admin_menu_where['id'] = $menu_id_arr;
        }
        $top_menu = $this->get_top_menu($admin_menu_where);

        $top_menu_1 = $this->get_top_menu(['level'=>1]);

        $top_menu_id = array();
        foreach ($top_menu_1 as $k=>$top){
            if($_SERVER['PATH_INFO']==('/'.$top['model'].'/'.$top['action'])){
                $top_menu_id = $top['parentid'];
            }
        }
        $url = new Url($routers);
        list($path,$class,$method) = $url->parse_path_class_method();
        list($left_menu,$left_menu_child) = $this->get_left_menu($path);

        return [$top_menu,$left_menu,$left_menu_child,$top_menu_id];

    }




}

##生成时间:2024-10-19 10:52:59 文件路径：E:\data\www\fish\web/../app//models/curd/AdminMenu.php🐘
<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace doc\models\doc;
use app\helpers\Tree;
use doc\base\Model;
use doc\base\exception\LogicException;
class UserStructure extends Model
{
    public $db = 'doc';
    public  $table='doc_user_structure';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }
    public function create($form){
        $res = $this->insert($form);
        if($res){
            throw  new LogicException(0,'添加成功');
        }else{
            throw  new LogicException(-1,'添加失败');
        }
    }
    public function save($form){
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'修改成功');
        }else{
            throw new LogicException(-1,'修改失败');
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
        $info['avator_url'] = str_replace('doc.php','',SITE_URL).'/upload/'.$info['avator'];
        return $info;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 20, $fields = '*')
    {
        $total = $this->get_total($where);
        $data = $this->get_list($where, $limit, $offset, $fields);
        foreach ($data as $k=>$v){
            $data[$k]['avator_url'] = str_replace('doc.php','',SITE_URL).'/upload/'.$v['avator'];
        }
        return [$data,$total['total']];
    }




    public static function get_config_status(){
        return [
            -1=>['id'=> -1,'name'=>'隐藏'],
            0=>['id'=>0,'name'=>'正常'],

        ];
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

    public function get_tree_array($parentid=null){
//         $tree = new Tree();
         $static_url =  str_replace('doc.php','upload/',SITE_URL);
        $tree_data = $this->find_all(['status'=>0],1,10000,'id,name, title,CONCAT("'.$static_url.'",avator) as image,parentid,title');
//        foreach ($tree_data as $k=>$v){
//            $tree_data[$k]['image'] = str_replace('doc.php','',SITE_URL).'/upload/'.$v['avator'];
//            $tree_data[$k]['avator'] = str_replace('doc.php','',SITE_URL).'/upload/'.$v['avator'];
//        }
//        $tree->init($tree_data);
//        $res = $tree->get_tree_array(0);
//        print_r($res);
//        $reform_res = [];
//        foreach ($res as $k=>$v){
//            $reform_res[] = $v;
//        }
        return $tree_data;
    }


}#end

##生成时间:2024-12-04 19:09:15 文件路径：UserStructure.php🐘
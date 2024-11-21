<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\models\curd\cms;
use app\base\Model;
use app\base\exception\LogicException;
class Collect extends Model
{
    public $db = 'cms';
    public  $table='cms_collect';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }
    public function create($form){
        $form['preg_list'] = addslashes  ($form['preg_list']);
        $form['preg_detail'] = addslashes  ($form['preg_detail']);
        $form['preg_title'] = addslashes  ($form['preg_title']);
        $form['preg_author'] = addslashes  ($form['preg_author']);
        $form['preg_media'] = addslashes  ($form['preg_media']);
        $form['preg_time'] = addslashes  ($form['preg_time']);
        $form['preg_content'] = addslashes  ($form['preg_content']);
        $form['addtime'] = time();
        $form['status'] = 0;
        $res = $this->insert($form);
        if($res){
            throw  new LogicException(0,'添加成功');
        }else{
            throw  new LogicException(-1,'添加失败');
        }
    }
    public function save($form){
        $form['preg_list'] = addslashes  ($form['preg_list']);
        $form['preg_detail'] = addslashes  ($form['preg_detail']);
        $form['preg_title'] = addslashes  ($form['preg_title']);
        $form['preg_author'] = addslashes  ($form['preg_author']);
        $form['preg_media'] = addslashes  ($form['preg_media']);
        $form['preg_time'] = addslashes  ($form['preg_time']);
        $form['preg_content'] = addslashes  ($form['preg_content']);
        $form['status'] = 0;
        $form['updatetime'] = time();
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'修改成功');
        }else{
            throw new LogicException(-1,'修改失败');
        }
    }

    public function delete($form){
        $form['status'] = -1;
        $form['deltime'] = time();
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
        foreach($data as $k=>$v){
            $data[$k]['addtime'] = date("Y-m-d H:i:s",$v['addtime']);
            $data[$k]['updatetime'] = date("Y-m-d H:i:s",$v['updatetime']);
            $data[$k]['deltime'] = date("Y-m-d H:i:s",$v['deltime']);
            $data[$k]['status'] = $this->get_config_status()[$v['status']]['name'];
        }
        return [$data,$total['total']];
    }




    public static function get_config_status(){
            return [
                0=>['id'=>0,'name'=>'正常'],
				-1=>['id'=>-1,'name'=>'删除'],
            ];
    }


}#end

##生成时间:2024-11-21 15:34:06 文件路径：Collect.php🐘
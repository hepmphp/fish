<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\models\curd\project;
use app\base\Model;
use app\base\exception\LogicException;
class Project extends Model
{
    public $db = 'project';
    public  $table='pj_project';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }
    public function create($form){
        $form['addtime'] = time();
        $res = $this->insert($form);
        if($res){
            throw  new LogicException(0,'添加成功');
        }else{
            throw  new LogicException(-1,'添加失败');
        }
    }
    public function save($form){
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
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'删除成功');
        }else{
            throw new LogicException(-1,'删除成功');
        }
    }

    public function info($data){
        $info = $this->find(['id'=>$data['id']],'*');
        $info['start_date'] = date("Y-m-d",$info['start_date']);
        $info['end_date'] = date("Y-m-d",$info['end_date']);
        return $info;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 20, $fields = '*')
    {
        $total = $this->get_total($where);
        $data = $this->get_list($where, $limit, $offset, $fields);
        foreach ($data as $k=>$v){
            $data[$k]['start_date'] = date("Y-m-d",$v['start_date']);
            $data[$k]['end_date'] = date("Y-m-d",$v['end_date']);
            $data[$k]['addtime'] = date("Y-m-d H:i:s",$v['addtime']);
            $data[$k]['updatetime'] = date("Y-m-d H:i:s",$v['updatetime']);
            $data[$k]['priority'] =$this->get_config_priority()[$v['priority']]['text'];
            $data[$k]['status'] =$this->get_config_status()[$v['status']]['text'];

        }
        return [$data,$total['total']];
    }




    public static function get_config_priority(){
            return [
                0=>['id'=>0,'name'=>'高','text'=>'<span class="number red">1</span>'],
				1=>['id'=>1,'name'=>'一般','text'=>'<span class="number blue">2</span>'],
				2=>['id'=>2,'name'=>'低','text'=>'<span class="number green">3</span>'],
                3=>['id'=>3,'name'=>'较低','text'=>'<span class="number indigo">3</span>'],
            ];
    }

	    public static function get_config_status(){
            return [
                -1=>['id'=>-1,'name'=>'删除','text'=>'<span class="number_block red">删除</span>'],
                1=>['id'=>1,'name'=>'新增','text'=>'<span class="number_block indigo">新增</span>'],
				2=>['id'=>2,'name'=>'等待审核','text'=>'<span class="number_block blue_see">等待审核</span>'],
				3=>['id'=>3,'name'=>'开启的','text'=>'<span class="number_block green">开启的</span>'],
				4=>['id'=>4,'name'=>'已完成','text'=>'<span class="number_block blue">已完成</span>'],

            ];
    }


}#end

##生成时间:2024-11-22 10:49:52 文件路径：Project.php🐘
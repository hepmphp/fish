<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\models\curd\publish;
use app\base\Model;
use app\base\exception\LogicException;
class Project extends Model
{
    public $db = 'publish';
    public  $table='pub_project';
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
        $form['status'] = 0;
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
        return $info;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 20, $fields = '*')
    {
        $total = $this->get_total($where);
        $data = $this->get_list($where, $limit, $offset, $fields);
        foreach ($data as $k=>$v){
            if($v['status']==-1){
                $data[$k]['status'] = "<span style='color: red;'>".$this->get_config_status()[$v['status']]['name']."</span>";
            }else{
                $data[$k]['status'] = $this->get_config_status()[$v['status']]['name'];
            }
            $data[$k]['addtime'] = date("Y-m-d H:i:s",$v['addtime']);
        }
        return [$data,$total['total']];
    }




    public static function get_config_type(){
            return [
                1=>['id'=>1,'name'=>'测试'],
				2=>['id'=>2,'name'=>'仿真'],
				3=>['id'=>3,'name'=>'线上'],

            ];
    }

	    public static function get_config_status(){
            return [
				0=>['id'=>0,'name'=>'正常'],
				-1=>['id'=>-1,'name'=>'删除'],
            ];
    }


}#end

##生成时间:2024-11-18 17:13:44 文件路径：Project.php🐘
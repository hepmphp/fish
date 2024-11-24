<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\models\curd\cloud_server;
use app\base\Model;
use app\base\exception\LogicException;
class ServerManager extends Model
{
    public $db = 'cloud';
    public  $table='cs_server_manager';
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
        $info['expire_time'] = date('Y-m-d H:i:s',$info['expire_time']);
        return $info;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 20, $fields = '*')
    {
        $total = $this->get_total($where);
        $data = $this->get_list($where, $limit, $offset, $fields);
        foreach ($data as $k=>$v){
            $data[$k]['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
            $data[$k]['deltime'] = date('Y-m-d H:i:s',$v['deltime']);
            $data[$k]['expire_time'] = date('Y-m-d H:i:s',$v['expire_time']);
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

##生成时间:2024-11-24 19:19:45 文件路径：ServerManager.php🐘
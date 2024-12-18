<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\models\curd\im;
use app\base\Model;
use app\base\exception\LogicException;
class Msgbox extends Model
{
    public $db = 'im';
    public  $table='chat_msgbox';
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
        return $info;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 20, $fields = '*')
    {
        $total = $this->get_total($where);
        $data = $this->get_list($where, $limit, $offset, $fields);
        foreach ($data as $k=>$v){
            $data[$k]['status'] = $this->get_config_status()[$v['status']]['name'];
            $data[$k]['type'] = $this->get_config_type()[$v['type']]['name'];
            $data[$k]['send_time'] = date("Y-m-d H:i:s",$v['send_time']);
            $data[$k]['read_time'] = date("Y-m-d H:i:s",$v['read_time']);
            $data[$k]['create_time'] = date("Y-m-d H:i:s",$v['create_time']);
            $data[$k]['update_time'] = date("Y-m-d H:i:s",$v['update_time']);
            $data[$k]['delete_time'] = date("Y-m-d H:i:s",$v['delete_time']);
        }
        return [$data,$total['total']];
    }




    public static function get_config_type(){
            return [
                0=>['id'=>0,'name'=>'请求添加用户'],
				1=>['id'=>1,'name'=>'系统消息(加好友) '],
				2=>['id'=>2,'name'=>'请求加群'],
				3=>['id'=>3,'name'=>'系统消息(加群)'],

            ];
    }

	    public static function get_config_status(){
            return [
                0=>['id'=>0,'name'=>'请求添加用户'],
				1=>['id'=>1,'name'=>'系统消息(加好友) '],
				2=>['id'=>2,'name'=>'请求加群'],
				3=>['id'=>3,'name'=>'系统消息(加群)'],
				0=>['id'=>0,'name'=>'待处理'],
				1=>['id'=>1,'name'=>'同意'],
				2=>['id'=>2,'name'=>'拒绝'],
				3=>['id'=>3,'name'=>'无须处理'],

            ];
    }


}#end

##生成时间:2024-11-17 22:45:47 文件路径：Msgbox.php🐘
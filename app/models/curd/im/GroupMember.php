<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\models\curd\im;
use app\base\Model;
use app\base\exception\LogicException;
class GroupMember extends Model
{
    public  $db = 'im';
    public  $table='chat_group_member';
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
            $data[$k]['status'] = $v['status']==0?'正常':'群黑名单';
            $data[$k]['type'] = $v['type']==0?'群主':'会员';
            $data[$k]['addtime'] = date('Y-m-d H:i:s',$v['addtime']);
            $data[$k]['forbidden_speech_time'] = date('Y-m-d H:i:s',$v['forbidden_speech_time']);
            $data[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
            $data[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
            $data[$k]['delete_time'] = date('Y-m-d H:i:s',$v['delete_time']);
        }
        return [$data,$total['total']];
    }




    public static function get_config_type(){
        return [
            0=>['id'=>0,'name'=>'群主'],
            1=>['id'=>1,'name'=>'会员'],

        ];
    }

    public static function get_config_status(){
        return [
            0=>['id'=>0,'name'=>'群主'],
            1=>['id'=>1,'name'=>'会员'],
            0=>['id'=>0,'name'=>'正常'],
            1=>['id'=>1,'name'=>'群黑名单'],

        ];
    }


}#end

##生成时间:2024-11-11 21:13:34 文件路径：GroupMember.php🐘
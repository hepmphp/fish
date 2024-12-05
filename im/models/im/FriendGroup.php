<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace im\models\im;
use im\base\Model;
use im\base\exception\LogicException;
class FriendGroup extends Model
{
    public  $db = 'im';
    public  $table='chat_friend_group';
    public  $db_prefix='';
    public  $friend = '';
    public function __construct()
    {
        $this->friend = new Friend();
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }
    public function create($form){
        $form['create_time'] = time();
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
        return [$data,$total['total']];
    }




    public static function get_config_status(){
        return [
            0=>['id'=>0,'name'=>'正常'],
            -1=>['id'=>-1,'name'=>'删除'],

        ];
    }

    public function get_group_member_list($belong_id=0){
        $groups = $this->find_all(['status'=>0]);
        foreach ($groups as $k=>$group) {
            $groups[$k]['groupname'] = $group['group_name'];
            $lists = $this->friend->find_all(['group_id'=>$group['id']],0,1000);
            $groups[$k]['list'] = $lists;

        }
        return $groups;
    }


}#end

##生成时间:2024-12-05 18:34:38 文件路径：FriendGroup.php🐘
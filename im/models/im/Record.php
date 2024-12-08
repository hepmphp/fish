<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace im\models\im;
use app\helpers\Arr;
use im\base\Model;
use im\base\exception\LogicException;
use im\models\im\Member;
use im\models\im\GroupMember;
class Record extends Model
{
    public $db = 'im';
    public  $table='chat_record';
    public  $db_prefix='';
    public $chat_member = '';
    public $chat_group_member = '';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        $this->chat_member = new Member();
        $this->chat_group_member = new GroupMember();
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
        $where_sql = $where;
        $where_sql = $where_sql." AND group_id=0";
        $total = $this->get_total($where_sql);
        $data = $this->get_list($where_sql, $limit, $offset, $fields);
        //根据用户id获取用户信息
        $to_ids = Arr::getColumn($data,'to_id');
        $to_ids = array_unique($to_ids);
        $members = $this->chat_member->find_all(['id'=>$to_ids],0,1000);
        $members = Arr::index($members,'id');

        foreach ($data as $k=>$v){
            if($v['to_id']){
                $avatar = $members[$v['to_id']]['avatar'];
                $data[$k]['avatar_url'] =  str_replace('im.php','',SITE_URL).'/upload/'.$avatar;
            }

        }
        return [$data,$total['total']];
    }

    public function get_group_list_info($where = array(), $limit = 1, $offset = 20, $fields = '*')
    {
        $total = $this->get_total($where);
        $data = $this->get_list($where, $limit, $offset, $fields);
        //根据用户id获取用户信息
        $group_ids = Arr::getColumn($data,'group_id');
        $group_ids = array_unique($group_ids);

        $chat_members = $this->chat_group_member->find_all(['group_id'=>$group_ids],0,1000);
        $member_ids = Arr::getColumn($chat_members,'member_id');

        $members = $this->chat_member->find_all(['id'=>$member_ids],0,1000);
        $members = Arr::index($members,'id');
//        print_r($data);
//        print_r($members);
        foreach ($data as $k=>$v){
            if(!empty($v['from_id'])){
                $avatar = $members[$v['from_id']]['avatar'];

            }elseif (!empty($v['to_id'])){
                $avatar = $members[$v['to_id']]['avatar'];
            }
            $data[$k]['avatar_url'] =  str_replace('im.php','',SITE_URL).'/upload/'.$avatar;

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

##生成时间:2024-12-08 12:51:19 文件路径：Record.php🐘
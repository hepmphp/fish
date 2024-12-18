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
class Msgbox extends Model
{
    public $db = 'im';
    public  $table='chat_msgbox';
    public  $db_prefix='';
    public $chat_member = '';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        $this->chat_member = new Member();
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
        $info['avatar_url'] =  str_replace('im.php','',SITE_URL).'/upload/'.$info['avatar'];
        return $info;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 20, $fields = '*')
    {
        $total = $this->get_total($where);
        $data = $this->get_list($where, $limit, $offset, $fields,'id desc');
//        //根据用户id获取用户信息
        $from_ids = Arr::getColumn($data,'from_id');
        $to_ids = Arr::getColumn($data,'to_id');
        $from_ids = array_unique($from_ids);
        $to_ids = array_unique($to_ids);
        $to_ids = array_merge($from_ids,$to_ids);
        $members = $this->chat_member->find_all(['id'=>$to_ids],0,1000);
        $members = Arr::index($members,'id');
        foreach ($data as $k=>$v){
            if($v['from_id']){
                $avatar = $members[$v['from_id']]['avatar'];
                $data[$k]['avatar_url'] =  str_replace('im.php','',SITE_URL).'/upload/'.$avatar;
            }
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
            0=>['id'=>0,'name'=>'待处理'],
            1=>['id'=>1,'name'=>'同意'],
            2=>['id'=>2,'name'=>'拒绝'],
            3=>['id'=>3,'name'=>'无须处理'],

        ];
    }


}#end

##生成时间:2024-12-05 22:23:42 文件路径：Msgbox.php🐘
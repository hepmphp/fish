<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace im\models\im;
use im\base\Model;
use im\base\exception\LogicException;
use im\helpers\Input;

class Group extends Model
{
    public $db ='im';
    public  $table='chat_group';
    public  $db_prefix='';

    public $group_member = '';

    public function __construct()
    {
        $this->group_member = new GroupMember();
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
        $info['avatar_url'] =  str_replace('im.php','',SITE_URL).'/upload/'.$info['avatar'];
        return $info;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 20, $fields = '*')
    {
        $total = $this->get_total($where);
        $data = $this->get_list($where, $limit, $offset, $fields);
        return [$data,$total['total']];
    }



    public function get_group_list($where=''){
        $data= $this->find_all($where,0,1000,'*');
        foreach ($data as $k=>$v){
            $data[$k]['username'] = $v['group_name'];
            $data[$k]['avatar_url'] =  str_replace('im.php','',SITE_URL).'/upload/'.$v['avatar'];
        }
        return $data;
    }

    public static function get_config_status(){
        return [
            0=>['id'=>0,'name'=>'正常'],
            -1=>['id'=>-1,'name'=>'全体禁言'],

        ];
    }




}#end

##生成时间:2024-12-05 16:24:44 文件路径：Group.php🐘
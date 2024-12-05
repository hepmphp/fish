<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\models\curd\im;
use app\base\Model;
use app\base\exception\LogicException;
use app\helpers\Unique;

class Member extends Model
{
    public $db = 'im';
    public  $table='chat_member';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }
    /**
     * 生成密码
     * @param $password
     * @param $salt
     * @return string
     */
    public function genrate_password($password,$salt){
        return md5($password.md5($salt));
    }

    public function create($form){

        $salt = Unique::gen_random_string();
        $form['password'] = $this->genrate_password($form['password'],$salt);
        $form['salt'] = $salt;
        $form['delete_status'] = 0;
        $form['create_time'] = time();
        $res = $this->insert($form);
        if($res){
            throw  new LogicException(0,'添加成功');
        }else{
            throw  new LogicException(-1,'添加失败');
        }
    }
    public function save($form){
        if(isset($form['password']) && !empty($form['password'])){
            $salt = Unique::gen_random_string();
            $form['password'] = $this->genrate_password($form['password'],$salt);
            $form['salt'] = $salt;
        }
        $form['update_time'] = time();

        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'修改成功');
        }else{
            throw new LogicException(-1,'修改失败');
        }
    }

    public function delete($form){
        $form['delete_status'] = -1;
        $res = $this->update($form,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'删除成功');
        }else{
            throw new LogicException(-1,'删除成功');
        }
    }

    public function info($data){
        $info = $this->find(['id'=>$data['id']],'*');
        $info['login_time'] = date('Y-m-d H:i:s',$info['login_time']);
        $info['create_time'] = date('Y-m-d H:i:s',$info['create_time']);
        $info['update_time'] = date('Y-m-d H:i:s',$info['update_time']);
        $info['delete_time'] = date('Y-m-d H:i:s',$info['delete_time']);
        $info['avatar_url'] = str_replace('index.php','',SITE_URL).'/upload/'.$info['avatar'];
        return $info;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 20, $fields = '*')
    {
        $total = $this->get_total($where);
        $data = $this->get_list($where, $limit, $offset, $fields);
        foreach ($data as $k=>$v){
            $data[$k]['status'] = $v['status']==0?'在线':'离线';
            $data[$k]['delete_status'] = $v['status']==0?'正常':'删除';
            $data[$k]['login_time'] = date('Y-m-d H:i:s',$v['login_time']);
            $data[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
            $data[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
            $data[$k]['delete_time'] = date('Y-m-d H:i:s',$v['delete_time']);
        }
        return [$data,$total['total']];
    }

    public static function get_config_status(){
        return [
            -1=>['id'=>-1,'name'=>'删除'],
            0=>['id'=>0,'name'=>'在线'],
            1=>['id'=>1,'name'=>'下线'],
            2=>['id'=>2,'name'=>'隐身'],

        ];
    }
    public static function get_config_delete_status(){
        return [
            0=>['id'=>0,'name'=>'正常'],
            -1=>['id'=>-1,'name'=>'删除'],

        ];
    }



}#end

##生成时间:2024-11-11 17:20:00 文件路径：Member.php🐘
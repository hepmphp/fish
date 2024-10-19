<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace models\curd;
use base\exception\LogicException;
use base\Model;
use helpers\Unique;

class AdminUser extends Model
{
    public  $table='ga_admin_user';
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


    public function create($data){
        $salt = Unique::gen_random_string();
        $password = $this->genrate_password($data['password'],$salt);
        $data['salt'] = $salt;
        $data['realname'] = $data['username'];
        $data['password'] = $password;
        $data['create_time'] = time();
        $data['mids'] = '1';
        $user_exits = $this->find(['username'=>$data['username']]);
        if($user_exits){
            throw  new  LogicException(-2,'管理员已经存在');
        }
        $res = $this->insert($data);
        if($res){
            throw new LogicException(0,'管理员添加成功');
        }else{
            throw new LogicException(-1,'管理员添加失败');
        }
    }

    public function save($data)
    {
        $user= $this->find(['username'=>$data['username']],'username,password,salt');
        if(!$user){
            throw  new  LogicException(-2,'管理员不存在');
        }
        $user['password'] = $this->genrate_password($data['password'],$user['salt']);
        $user['update_time'] = time();
        $res = $this->update($user,['username'=>$data['username']],1);
        if($res){
            throw new LogicException(0,'管理员修改成功');
        }else{
            throw new LogicException(-1,'管理员修改失败');
        }
    }

    public function delete($data){
        $user= $this->find(['username'=>$data['username']],'username,password,salt');
        if(!$user){
            throw  new  LogicException(-2,'管理员不存在');
        }
        $user['update_time'] = time();
        $user['status'] = -1;
        $res = $this->update($user,['username'=>$data['username']],1);
        if($res){
            throw new LogicException(0,'管理员修改成功');
        }else{
            throw new LogicException(-1,'管理员修改失败');
        }
    }

    public function login($data){
        $user= $this->find(['username'=>$data['username']],'id,username,password,salt');
        if($user['password']== $this->genrate_password($data['password'],$user['salt'])){
            throw  new  LogicException(-2,'管理员不存在');
        }
        $user['update_time'] = time();
        $user['last_session_id'] = session_id();
        $res = $this->update($user,['username'=>$data['username']],1);
        if(!$res){
            throw new LogicException(0,'管理员信息修改失败');
        }

        $res['id'] = $user['id'];
        $res['username'] = $user['username'];
        $res['time'] = time();
        $res['expiret_at'] =  $res['time'] +86400;//有效时间1小时
        $res['access_token'] = md5($data['username'].$res['time'].'201803');
        return $res;
    }

    public function info($data){
        $user= $this->find(['username'=>$data['username']],'*');
        return $user;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 100, $fields = '*')
    {
        $users = $this->get_list($where,$limit,$offset,$fields);
        return $users;
    }


}

##生成时间:2024-10-19 10:52:59 文件路径：E:\data\www\fish\web/../app//models/curd/AdminUser.php🐘
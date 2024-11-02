<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace models\curd;
use base\exception\LogicException;
use base\Model;
use helpers\Arr;
use helpers\Cookie;
use helpers\Unique;

class AdminUser extends Model
{
    public  $table='admin_user';
    public  $db_prefix='';

    public  $admin_group='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        $this->admin_group = new AdminGroup();
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
        $user= $this->find(['id'=>$data['id']],'id,username,password,salt');
        if(!$user){
            throw  new  LogicException(-2,'管理员不存在');
        }
        $user['password'] = $this->genrate_password($data['password'],$user['salt']);
        $user['update_time'] = time();
        $user['status'] = 0 ;
        $res = $this->update($user,['id'=>$data['id']],1);
        if($res){
            throw new LogicException(0,'管理员修改成功');
        }else{
            throw new LogicException(-1,'管理员修改失败');
        }
    }

    public function edit_permission($data){
        $user= $this->find(['id'=>$data['id']],'id,username,password,salt');
        if(!$user){
            throw  new  LogicException(-2,'管理员不存在');
        }
        $data['update_time'] = time();
        $res = $this->update($data,['id'=>$data['id']],1);
        if($res){
            throw new LogicException(0,'管理员权限设置成功');
        }else{
            throw new LogicException(-1,'管理员权限设置失败');
        }
    }

    public function delete($data){
        $user= $this->find(['id'=>$data['id']],'id,username,password,salt');
        if(!$user){
            throw  new  LogicException(-2,'管理员不存在');
        }
        $user['update_time'] = time();
        $user['status'] = -1;
        $res = $this->update($user,['id'=>$data['id']],1);
        if($res){
            throw new LogicException(0,'管理员锁定成功');
        }else{
            throw new LogicException(-1,'管理员锁定失败');
        }
    }

    public function login($data){
        $data['password'] = trim($data['password']);
        $user= $this->find(['username'=>$data['username']],'id,username,group_id,mids,password,salt');
        if(empty($user)){
            throw  new  LogicException(-1,'管理员不存在');
        }
       // var_dump($user['password'],$this->genrate_password($data['password'],$user['salt']));
        if($user['password'] != $this->genrate_password($data['password'],$user['salt'])){
            throw  new  LogicException(-2,'管理员密码不正确');
        }
        $group = $this->admin_group->info(['id'=>$user['group_id']]);
        $user['last_login_time'] = time();
        $user['last_session_id'] = session_id();
        $return['id'] = $user['id'];
        //登录 保存session
        $_SESSION['admin_user_id'] = $user['id'];
        $_SESSION['admin_user_username'] = $user['username'];
        $_SESSION['admin_user_mids'] = !empty($user['mids']) && strpos($user['mids'],',')!==0?explode(',',$user['mids']):'';
        $_SESSION['admin_user_last_login_time'] = $user['last_login_time'];
        $_SESSION['admin_user_session_id'] = $user['last_session_id'];
//        $_SESSION['admin_user.platform_id'] = $user['platform_id'];
        $_SESSION['admin_user_group_id'] = $user['group_id'];
        $_SESSION['admin_user_allow_mutil_login'] = isset($group['allow_mutil_login'])?$group['allow_mutil_login']:0;//是否启用账号踢出功能

        Cookie::set('admin_cookie',"{$_SESSION['admin_user_id']}|{$_SESSION['admin_user_session_id']}|{$_SESSION['admin_user_username']}|{$_SESSION['admin_user_group_id']}|{$_SESSION['admin_user_allow_mutil_login']}");
        unset($user['id']);
        $res = $this->update($user,['username'=>$data['username']],1);
        if(!$res){
            throw new LogicException(0,'管理员信息修改失败');
        }
        return $return;
    }

    public function info($data){
        $user= $this->find($data,'*');
        return $user;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 100, $fields = '*')
    {
       // var_dump($limit,$offset);
        $users = $this->get_list($where,$limit,$offset,$fields);
        $groups = $this->admin_group->find_all('',0);
//        $groups = Arr::index($groups,'id');
//        var_dump($groups);
        foreach ($users as $k=>$v){
            $users[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
            $users[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
            if(isset($v['group_id']) && isset( $groups[$v['group_id']])){
                $users[$k]['group_name'] = $groups[$v['group_id']]['name'];
            }
            if($users[$k]['status']==-1){
                $users[$k]['status_name'] = '<span class="label btn-danger" style="background-color: red;" >锁定</span>';
            }else{
                $users[$k]['status_name'] = '<span class="label btn-success" style="background-color: green;" >正常</span>';
            }
        }
        $total = $this->get_total($where);
        return [$users,$total['total']];
    }


}

##生成时间:2024-10-19 10:52:59 文件路径：E:\data\www\fish\web/../app//models/curd/AdminUser.php🐘
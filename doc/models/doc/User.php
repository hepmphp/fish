<?php

/**
 *  fiename: fish/Users.php$🐘
 *  date: 2024/10/18 12:30:14$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace doc\models\doc;
use app\helpers\Unique;
use doc\base\Model;
use doc\base\exception\LogicException;
use app\helpers\Session;
use app\helpers\Cookie;

class User extends Model
{
    public $db = 'doc';
    public  $table='doc_user';
    public  $db_prefix='';

    public function __construct()
    {
        $this->table = $this->db_prefix.$this->table;
        parent::__construct();
    }
    public function create($form){
        $form['salt'] = Unique::gen_random_string(6);
        $form['password'] = $this->genrate_password($form['password'],$form['salt']);
        $form['status'] = 0;
        $form['addtime'] = time();
        $user_exists = $this->info(['username'=>$form['username']]);
        if(isset($user_exists['id'])){
            throw  new LogicException(-1,'用户名已经存在');
        }

        $res = $this->insert($form);
        if($res){
            throw  new LogicException(0,'用户注册成功');
        }else{
            throw  new LogicException(-1,'用户注册失败');
        }
    }
    public function save($form){
        $user= $this->find(['id'=>$form['id']],'*');
        if(empty($user)){
            throw  new  LogicException(-1,'用户不能在');
        }

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

    public function genrate_password($password,$salt){
        return md5($password.md5($salt));
    }

    public function info($where){
        $info = $this->find($where,'*');
        return $info;
    }

    public function get_list_info($where = array(), $limit = 1, $offset = 20, $fields = '*')
    {
        $total = $this->get_total($where);
        $data = $this->get_list($where, $limit, $offset, $fields);
        return [$data,$total['total']];
    }

    public function login($form,$login_code=0){
        if(preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$/i", $form['username'])){
            $user= $this->find(['email'=>$form['username']],'*');
        }else{
            $user= $this->find(['username'=>$form['username']],'*');
        }
        if(empty($user)){
            throw  new  LogicException(-1,'用户不能在');
        }
        if($login_code==0){
            if($user['password'] != $this->genrate_password($form['password'],$user['salt'])){
                throw  new  LogicException(-2,'用户名或者密码不正确');
            }
        }

        $user['last_login_time'] = time();
        //登录 保存session
        $_SESSION['doc_user_id'] = $user['id'];
        $_SESSION['doc_user_username'] = $user['username'];
        $_SESSION['doc_avator'] = $user['avator'];
        $_SESSION['doc_last_login_time'] = $user['last_login_time'];
        Cookie::set('doc_cookie',"{$_SESSION['doc_user_id']}|{$_SESSION['doc_user_username']}|{$_SESSION['doc_last_login_time']}");
        throw new LogicException(0,'用户登录成功');
    }

    public function save_password($form)
    {
        $user= $this->find(['id'=>$form['id']],'*');
        if(empty($user)){
            throw  new  LogicException(-1,'用户不能在');
        }
        if($user['password'] != $this->genrate_password($form['old_password'],$user['salt'])){
            throw  new  LogicException(-2,'用户名或者密码不正确');
        }
        unset($form['old_password']);

        $user['password'] = $this->genrate_password($form['password'],$user['salt']);
        $user['update_time'] = time();
        $user['status'] = 0 ;
        $res = $this->update($user,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'用户信息修改成功');
        }else{
            throw new LogicException(-1,'用户信息修改失败');
        }
    }

    public function save_password_by_mail($form)
    {
        $user= $this->find(['id'=>$form['id']],'*');
        if(empty($user)){
            throw  new  LogicException(-1,'用户不能在');
        }
        $user['password'] = $this->genrate_password($form['password'],$user['salt']);
        $user['update_time'] = time();
        $user['status'] = 0 ;
        $res = $this->update($user,['id'=>$form['id']],1);
        if($res){
            throw new LogicException(0,'密码重置成功');
        }else{
            throw new LogicException(-1,'密码重置失败');
        }
    }

    public function email_code($id){
        $email_code = md5('fish_ok_'.$id);
        return $email_code;
    }

}#end

##生成时间:2024-11-06 00:15:12 文件路径：User.php🐘
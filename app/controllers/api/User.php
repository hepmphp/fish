<?php
/**
 *  fiename: fish/User.php$🐘
 *  date: 2024/10/19 18:56:31$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\api;
use base\exception\LogicException;
use helpers\Input;
use helpers\Validate;
use helpers\Debug;
use models\curd\AdminUser;

class User extends \base\BaseController{
    
    public $admin_user;
    
    public function __construct()
    {
        $this->admin_user = new AdminUser();
    }


    public function get_search_where(){
         $where['username'] = Input::get_post('username');
         return $where;
    }

    public function create(){
        $data['username'] = Input::get_post('username');
        $data['password'] = Input::get_post('password');
         if(!Validate::required($data['username'])){
             throw  new LogicException(100,'管理员不能为空');
         }
         if(!Validate::min_length($data['password'],6)){
             throw new LogicException(200,'管理员密码不能小于6位数');
         }

        $this->admin_user->create($data);


    }
    public function update(){
        $data['id'] = Input::get_post('id');
        $data['username'] = Input::get_post('username');
        $data['password'] = Input::get_post('password');
        $data['re_password'] =  Input::get_post('re_password');
        if(!Validate::required($data['username'])){
            throw  new LogicException(100,'管理员不能为空');
        }
        if(!Validate::min_length($data['password'],6)){
            throw new LogicException(200,'管理员密码不能小于6位数');
        }
        if($data['password']!=$data['re_password']){
            throw new LogicException(300,'两次输入的密码不一致');
        }
        $this->admin_user->save($data);
    }
    public function delete(){
        $data['id'] = Input::get_post('id');
        $data['username'] = Input::get_post('username');
        $data['status'] = Input::get_post('status');
        if(!Validate::required($data['username'])){
            throw  new LogicException(100,'管理员不能为空');
        }
        $this->admin_user->delete($data);
    }

    public function login(){
        $data['username'] = Input::get_post('username');
        $data['password'] = Input::get_post('password');
        $res =$this->admin_user->login($data);
        $res['url'] = '/admin/user/index';
        if($res){
            Input::ajax_return(0,'登录成功',$res);
        }else{
            throw new LogicException(100,'管理员登录失败');
        }
    }

    public function info(){
        $data['username'] = Input::get_post('username');
        $res = $this->admin_user->info($data);
        if($res){
             Input::ajax_return(0,'获取数据成功',$res);
        }else{
            throw new LogicException(100,'获取数据失败');
        }
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page');
        $per_page = Input::get_post('per_page');
        list($res,$total) = $this->admin_user->get_list_info($where,$per_page,$page,'*');
        $data['list'] = $res;
        $data['total'] = $total;
        $data['page'] =$page;
        $data['per_page'] = $per_page;
        if($res){
            Input::ajax_return(0,'获取数据成功',$data);
        }else{
            throw new LogicException(100,'获取数据失败');
        }
    }



}

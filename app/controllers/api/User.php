<?php
/**
 *  fiename: fish/User.php$🐘
 *  date: 2024/10/19 18:56:31$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\api;
use base\exception\LogicException;
use helpers\Cookie;
use helpers\Input;
use helpers\Session;
use helpers\Validate;
use helpers\Debuger;
use models\curd\AdminUser;

class User extends \base\BaseController{
    
    public $admin_user;
    
    public function __construct()
    {
        $this->admin_user = new AdminUser();
    }


    public function get_search_where(){
         $where['username'] = Input::get_post('username','','trim');
         $start_time = Input::get_post('start_time');
         $end_time = Input::get_post('end_time');
         if(!empty($start_time)){
             $where['create_time>'] =strtotime($start_time);
         }
         if(!empty($end_time)){
             $where['create_time<'] = strtotime($end_time);
         }
        $where = array_filter($where);
        if(empty($where)){
            $where = '';
        }
         return $where;
    }

    public function create(){
        $data['username'] = Input::get_post('username');
        $data['realname'] = Input::get_post('realname');
        $data['password'] = Input::get_post('password');
        $data['re_password'] = Input::get_post('re_password');
        $data['group_id'] = Input::get_post('group_id');
         if(!Validate::required($data['username'])){
             throw  new LogicException(100,'管理员不能为空');
         }
         if(!Validate::min_length($data['password'],6)){
             throw new LogicException(200,'管理员密码不能小于6位数');
         }
         if($data['password']!=$data['re_password']){
             throw new LogicException(300,'两次输入的密码不一致');
         }
         if(isset($data['re_password'])){
             unset($data['re_password']);
         }
        $this->admin_user->create($data);
    }
    public function update(){
        $form['id'] = Input::get_post('id');
        $form['password'] = Input::get_post('password');
        $form['re_password'] =  Input::get_post('re_password');
        $form['mids'] = Input::get_post('mids');
        if(!Validate::min_length($form['password'],6)){
            throw new LogicException(200,'管理员密码不能小于6位数');
        }
        if($form['password']!=$form['re_password']){
            throw new LogicException(300,'两次输入的密码不一致');
        }
        if(isset( $form['username'])){
            unset( $form['username']);
        }
        $this->admin_user->save($form);
    }

    public function edit_permission(){
        $form['id'] = Input::get_post('id',0,'intval');
        $form['mids'] = Input::get_post('mids');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'用户id不能为空');
        }
        if(!Validate::required($form['mids'])){
            throw  new LogicException(100,'请勾选权限');
        }
        $this->admin_user->edit_permission($form);

    }
    public function delete(){
        $form['id'] = Input::get_post('id','','intval');
        if(!Validate::required($form['id'])){
            throw  new LogicException(100,'管理员不能为空');
        }
        $this->admin_user->delete($form);
    }

    public function login(){
        $data['username'] = Input::get_post('username');
        $data['password'] = Input::get_post('password');
        $this->admin_user->login($data);
        $res = array();
        $res['admin_url'] = '/admin/user/welcome?iframe=0';
        if($res){
            Input::ajax_return(0,'登录成功',$res);
        }else{
            throw new LogicException(100,'管理员登录失败');
        }
    }

    public function logout(){
        Session::session_destroy();
        Cookie::clear();
        $data['login_url'] = '/admin/user/login';
        Input::ajax_return(0,'登录成功',$data);
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
        list($res,$total) = $this->admin_user->get_list_info($where,$page,$per_page,'*');
        $data['list'] = $res;
        $data['total'] = $total;
        $data['page'] =$page;
        $data['per_page'] = $per_page;
        if($res){
            Input::ajax_return(0,'获取数据成功',$data);
        }else{
            throw new LogicException(100,'没有数据');
        }
    }



}

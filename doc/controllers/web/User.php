<?php
/**
 *  fiename: fish/User.php$🐘
 *  date:  2024/11/4   22:59$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace doc\controllers\web;

use app\helpers\Arr;
use app\helpers\Ding;
use doc\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Session;
use app\helpers\Validate;
use app\helpers\VerifyCode;
use doc\base\DocController;
use doc\models\doc\User as M_User;
use app\helpers\email\Email;

class User extends DocController {
    public $user=array();
    public function __construct()
    {

        $this->user = new M_User();
        parent::__construct();
    }

    public function index(){
        $this->view->display('doc/web/user/index');
    }

    public function register(){
        $this->view->display('doc/web/user/register');
    }

    public function create(){
        $form['avator'] = Input::get_post('avator','','trim');
        $form['username'] = Input::get_post('username','','trim');
        $form['email'] = Input::get_post('email','','trim');
        $form['password'] = Input::get_post('password','','trim');
        $code = Input::get_post('code','','trim');
        if(!Validate::required($form['username'])){
            throw new LogicException(-1,'用户名错误');
        }
        if(!Validate::required($form['password'])){
            throw new LogicException(-1,'密码不能为空');
        }

        $verify_code = new VerifyCode();
        if(!$verify_code->check($code)){
            throw new LogicException(-1,'验证码输入错误');
        }
        $this->user->create($form);
    }

    public function login(){
        if(Input::is_ajax()){
            $form['username'] = Input::get_post('username','','trim');
            $form['password'] = Input::get_post('password','','trim');
            if(!Validate::required($form['username'])){
                throw new LogicException(-1,'用户名错误');
            }
            if(!Validate::required($form['password'])){
                throw new LogicException(-1,'密码不能为空');
            }
            $this->user->login($form);
        }else{
            $this->view->display('doc/web/user/login');
        }
    }

    public function password(){
        if(Input::is_ajax()){
            $form['id'] = $_SESSION['doc_user_id'];
            $form['old_password'] = Input::get_post('old_password','','trim');
            $form['password'] = Input::get_post('password','','trim');
            $form['re_password'] = Input::get_post('re_password','','trim');
            if(!Validate::required($form['password'])){
                throw new LogicException(-1,'旧密码错误');
            }
            if(!Validate::required($form['password'])){
                throw new LogicException(-1,'密码不能为空');
            }
            if($form['password']!=$form['re_password']){
                throw new LogicException(-1,'两次密码输入不一样');
            }
            unset($form['re_password']);
            $this->user->save_password($form);

        }else {
            $this->view->display('doc/web/user/password');
        }
    }

    public function info(){
        if(Input::is_ajax()){
            $form['id'] = $_SESSION['doc_user_id'];
            $form['avator'] = Input::get_post('avator','','trim');

            if(!Validate::required($form['id'])){
                throw new LogicException(-1,'用户不存在');
            }
            $form['password'] = Input::get_post('password','','trim');
            $form['re_password'] = Input::get_post('re_password','','trim');
            if(!Validate::required($form['password'])){
                throw new LogicException(-1,'旧密码错误');
            }
            if(!Validate::required($form['password'])){
                throw new LogicException(-1,'密码不能为空');
            }
            if($form['password']!=$form['re_password']){
                throw new LogicException(-1,'两次密码输入不一样');
            }
            unset($form['re_password']);
            $this->user->save($form);
        }else {
            $form['id'] = $_SESSION['doc_user_id'];
            $form = $this->user->info(['id'=>$form['id']]);
            $this->view->assign('form',$form);
            $form['admin_url'] = '/doc.php/web/user/info?iframe=1';
            $this->view->assign('form',$form);
            if(isset($_GET['iframe']) && $_GET['iframe']==1){
                $this->view->display('doc/web/user/info');
            }else{
                $this->view->display('doc/web/user_structure/index_iframe');
            }
        }
    }

    public function user_bind(){
        $this->view->display('doc/web/user/user_bind');
    }
    public function logout(){
        Session::session_destroy();
        throw new LogicException(0,'退出成功');
    }

    public function find_password(){
        $this->view->display('doc/web/user/find_password');
    }

    public function reset_password(){
        $email = Input::get_post('username','','trim');
        $user_exists = $this->user->info(['email'=>$email]);
        if(empty($user_exists['id'])){
            throw new LogicException(-100,'用户账号错误');
        }
        $code = Input::get_post('code','','trim');
        $captcha = new VerifyCode();
        if(!$captcha->check($code)){
            throw new LogicException(-100,'验证码错误');
        }

        $reset_mail_url = 'http://127.0.0.1/doc.php/web/user/reset_password_mail_html?user_id=%s&fish_code=%s';
        $reset_mail_url = sprintf($reset_mail_url,$user_exists['id'],md5(date('Ymd').'fish_ok_'.$user_exists['id']));

        $message = file_get_contents(DOC_PATH.'views/doc/web/user/reset_password_mail_template.php');
        $message = str_replace(['[email]','[reset_mail_url]'],[$email,$reset_mail_url],$message);

        $phpmail = new Email();
        $phpmail->addTo($email);
        $phpmail->Subject('用户邮箱绑定验证码');
        $phpmail->Body($message);
        if($phpmail->Send()){
            $this->view->assign('email',$email);
            $this->view->display('doc/web/user/reset_password_mail_success');
        }else{
            throw new LogicException(-100,'密码重置邮件发送失败,请稍后再试一下:)');
        }


    }

    public function reset_password_mail_html(){

        $user_id = Input::get_post('user_id','','trim');
        if(empty($user_id)){
            throw new LogicException(-100,'用户账号错误');
        }
        $fish_code = Input::get_post('fish_code','','trim');
        if($fish_code!=md5(date('Ymd').'fish_ok_'.$user_id)){
            throw new LogicException(-100,'验证码错误');
        }
        $form['fish_code'] = $fish_code;
        $form['user_id'] = $user_id;
        $this->view->assign('form',$form);
        $this->view->display('doc/web/user/reset_password_mail_html');
    }

    public function reset_password_mail(){

        $user_id = Input::get_post('user_id','','trim');
        if(empty($user_id)){
            throw new LogicException(-100,'用户账号错误');
        }
        $fish_code = Input::get_post('fish_code','','trim');
        if($fish_code!=md5(date('Ymd').'fish_ok_'.$user_id)){
            throw new LogicException(-100,'验证码错误');
    }
        $password = Input::get_post('password','','trim');
        $this->user->save_password_by_mail(['id'=>$user_id,'password'=>$password]);
    }


    public function ding_login(){
        $this->view->display('doc/web/user/ding/ding_login');
    }
    public function ding_admin_login(){
        $this->view->display('doc/web/user/ding/ding_admin_login');
    }
    public function ding_login_return(){
        $ding_data = (new Ding())->login_return($_GET);
        if(isset($ding_data['errcode']) && $ding_data['errcode']==0){
            $s_user_id = $_SESSION['doc_user_id'];
            $user = $this->user->info(['id'=>$s_user_id]);
            $data['ding_nick'] = $ding_data['user_info']['nick'];
            $data['ding_staus'] = 1;
            $where['id'] = $user['id'];
            $res = $this->user->update($data,$where,1);
            $this->view->display('doc/web/user/ding/ding_success');


        }else{
            $this->view->display('doc/web/user/ding/ding_fail');
        }
    }

    public function ding_login_admin_return(){
        $ding_data = (new Ding())->login_return($_GET);
        if(isset($ding_data['errcode']) && $ding_data['errcode']==0){
            $s_user_id = $_SESSION['doc_user_id'];
            $user = $this->user->find(['ding_nick'=>$ding_data['user_info']['nick']]);
            $form['username'] = $user['email'];
            $res = array();
            $res = $this->user->login($form,1);
            $res['admin_url'] = '/doc.php';
            $this->view->assign('form',$res);
            $this->view->display('doc/web/user/ding/ding_admin_success');
        }else{
            $this->view->display('doc/web/user/ding/ding_fail');
        }
    }


    public function email(){
        $form['id'] = Input::get_post('id','','intval');
        $form = $this->user->info(['id'=>$form['id']]);
        $this->view->assign('form',$form);
        $this->view->display('doc/web/user/email/mail');
    }

    public function send_mail(){
        $form['id'] = Input::get_post('id','','intval');
        $email = Input::get_post('email');
        if(empty($email)){
            throw new LogicException(-100,'用户邮箱错误');
        }

        $user = $this->user->find(['email'=>$email],'id,username,email');
        $email_code = $this->user->email_code($user['id']);
        if(empty($form['id'])){
            $message = file_get_contents(DOC_PATH.'views/doc/web/user/email/mail_login_template.php');
        }else{
            $message = file_get_contents(DOC_PATH.'views/doc/web/user/email/mail_template.php');
        }
        $message = str_replace(['[email]','[email_code]'],[$email,$email_code],$message);

        $phpmail = new Email();
        $phpmail->addTo($email);
        $phpmail->Subject('用户邮箱绑定验证码');
        $phpmail->Body($message);
        if($phpmail->Send()){
            Input::ajax_return(0,'邮件发送成功,请查收邮件',$form);
        }else{
            Input::ajax_return(-100,'邮箱绑定失败',$form);
        }
    }
    public function bind_email(){
        $form['id'] = Input::get_post('id','','intval');
        $form['email'] = Input::get_post('email','','trim');
        $form_email_code = Input::get_post('email_code','','trim');
        $email_code = $this->user->email_code($form['id']);
        if($form_email_code!=$email_code){
            throw new LogicException(-100,'绑定验证码错误');
        }
        $form['email_status'] = 1;
        $form['admin_url'] = '';
        $res = $this->user->update($form,['id'=>$form['id']]);
        if($res){
            Input::ajax_return(0,'用户绑定邮箱成功',$form);
        }else{
            Input::ajax_return(-100,'邮箱绑定失败',$form);
        }
    }



}
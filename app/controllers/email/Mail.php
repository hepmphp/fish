<?php

namespace app\controllers\email;
use app\base\BaseController;
use app\helpers\email\Email;
use app\helpers\email\MailTool;
use app\helpers\Input;
use app\models\curd\cloud_server\MailServer;

class Mail extends BaseController{

    public $mail_tool = '';
    public $mail_server = '';
     public function __construct()
     {
         $this->mail_server = new MailServer();
         $this->mail_tool = new MailTool();
         parent::__construct();
     }

    public function get_search_where(){
        $id = Input::get_post('id');
        $where['id'] = $id;
        return $where;
    }

     public function index(){
         $data = $this->get_search_where();
         $server = $this->mail_server->info(['id'=>$data['id']]);
         $_SESSION['stmp_server'] = $server['stmp_server'];
         $_SESSION['imap_server'] = $server['imap_server'];
         $_SESSION['stmp_port'] = $server['stmp_port'];
         $_SESSION['imap_port'] = $server['imap_port'];
         $_SESSION['username'] = $server['username'];
         $_SESSION['password'] = $server['password'];
         $data['admin_url'] = '/email/mail/index?iframe=1';
         $this->view->assign('data',$data);
         if(isset($_GET['iframe']) && $_GET['iframe']==1){
             $this->view->display('email/mail/index');
         }else{
             $this->view->display('admin/root/admin_iframe');
         }
     }

     public function info(){
         $mail_id = Input::get_post('mail_id','1','trim');
         $form = $this->mail_tool->get_mail_detail($mail_id);
         $this->view->assign('form',$form);
         $this->view->display('email/mail/info');
     }

     public function mail_form(){
         $this->view->display('email/mail/mail_form');
     }
     public function send_mail(){
         $email = Input::get_post('to','','trim');
         $subject = Input::get_post('subject','','trim');
         $content= Input::get_post('content');
         $phpmail = new Email();
         $phpmail->addTo($email);
         $phpmail->Subject($subject);
         $phpmail->Body($content);
         if($phpmail->Send()){
             Input::ajax_return(0,'邮件发送成功');
         }else{
             Input::ajax_return(-100,'邮箱绑定失败');
         }
     }

 }
<?php
/**
 *  fiename: fish/User.php$🐘
 *  date: 2024/10/20 20:44:38$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\admin;
use app\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Msg;
use app\helpers\qrcode\TekinQR;
use app\helpers\Session;
use app\helpers\WeixinLogin;
use app\models\curd\AdminGroup;
use app\models\curd\AdminMenu;
use app\models\curd\AdminUser;
use app\base\BaseController;
use  app\helpers\Email;
use app\helpers\Ding;

class  User extends BaseController{

    public $admin_user;
    public $admin_menu;
    public $admin_group;

    public function __construct()
    {
        $this->admin_menu = new AdminMenu();
        $this->admin_user = new AdminUser();
        $this->admin_group = new AdminGroup();
        parent::__construct();
    }

    public function get_search_where(){
        $where['id'] = Input::get_post('id');
        $where['username'] = Input::get_post('username');
        $where['level']    = 0;
        if(isset($_GET['level'])){
            $level = Input::get_post('level',0);
            $where['level'] = intval($level);
        }
        $where = array_filter($where);
        return $where;
    }

    public function welcome(){
        $data = $this->get_search_where();
        $data['admin_url'] = '/admin/user/welcome?iframe=1';
        $this->view->assign('data',$data);
        if(isset($_GET['iframe']) && $_GET['iframe']==1){
            $this->view->display('admin/user/welcome');
        }else{
           $this->view->display('admin/root/admin_iframe');
        }
    }

    public function index(){
        $data = $this->get_search_where();
        $data['admin_url'] = '/admin/user/get_list?iframe=1';
        $this->view->assign('data',$data);
        if(isset($_GET['iframe']) && $_GET['iframe']==1){
            $this->view->display('admin/user/index');
        }else{
            $this->view->display('admin/root/admin_iframe');
        }
    }

    public function create(){
        $form['id'] = '';
        $form['username'] = '';
        $form['realname'] = '';
        $form['password'] = '';
        $form['re_password'] = '';
        $form['group_id'] = 0;
        $user_group = $this->admin_group->find_all_group(['group_id'=>$form['group_id']]);
        $this->view->assign('form',$form);
        $this->view->assign('user_group',$user_group);
        $this->view->display('admin/user/create');
    }

    public function update(){
        $form['id'] = Input::get_post('id');
        $user_group = $this->admin_group->find_all_group([]);
        $user = $this->admin_user->info(['id'=>$form['id']]);
        $form = $user;
        $this->view->assign('form',$form);
        $this->view->assign('user_group',$user_group);
        $this->view->display('admin/user/create');
    }

    public function login(){
        $this->view->display('admin/user/login/login');
    }


    public function get_list(){
        $data = $this->get_search_where();
        $top_menu = $this->admin_menu->get_top_menu(0);
        $this->view->assign('top_menu',$top_menu);
        $this->view->assign('data',$data);
        if(isset($_GET['iframe']) && $_GET['iframe']==1){
            $this->view->display('admin/user/user_list');
        }else{
            $this->view->display('admin/user/index');

        }
    }

    public function edit_permission(){
        $form = $this->get_search_where();
        $menu_data = $this->admin_menu->get_tree_array($form);
        $menu_data = json_encode($menu_data,JSON_UNESCAPED_UNICODE);
        $user_info = $this->admin_user->info(['id'=>$form['id']]);
        $admin_info_mids = array();
        if(isset($user_info['mids']) && !empty($user_info['mids'])){
            $admin_info_mids = explode(',',$user_info['mids']);
        }
        //var_dump($admin_info_mids);
        $this->view->assign('form',$form);
        $this->view->assign('admin_info_mids',json_encode($admin_info_mids));
        $this->view->assign('menu_data',$menu_data);
        $this->view->display('admin/group/edit_permission');
    }

    public function user_info(){
        $form['id'] = Input::get_post('id','','intval');
        $user = $this->admin_user->info(['id'=>$form['id']]);
        $form = $user;
        $this->view->assign('form',$form);
        $this->view->display('admin/user/user_info');
    }
    public function ding_login(){
        $this->view->display('admin/user/ding/ding_login');
    }
    public function ding_admin_login(){
        $this->view->display('admin/user/ding/ding_admin_login');
    }
    public function ding_login_return(){
         $ding_data = (new Ding())->login_return($_GET);
         if(isset($ding_data['errcode']) && $ding_data['errcode']==0){
             $s_user_id = $_SESSION['admin_user_id'];
             $user = $this->admin_user->info(['id'=>$s_user_id]);
             $data['ding_nick'] = $ding_data['user_info']['nick'];
             $data['ding_staus'] = 1;
             $where['id'] = $user['id'];
             $res = $this->admin_user->update($data,$where,1);
             $this->view->display('admin/user/ding/ding_success');


         }else{
             $this->view->display('admin/user/ding/ding_fail');
         }
    }

    public function ding_login_admin_return(){
        $ding_data = (new Ding())->login_return($_GET);
        if(isset($ding_data['errcode']) && $ding_data['errcode']==0){
            $s_user_id = $_SESSION['admin_user_id'];
            $user = $this->admin_user->find(['ding_nick'=>$ding_data['user_info']['nick']]);
            $form['username'] = $user['email'];
            $res = array();
            $res = $this->admin_user->login($form,1);
            $this->view->assign('form',$res);
            $this->view->display('admin/user/ding/ding_admin_success');
        }else{
            $this->view->display('admin/user/ding/ding_fail');
        }
    }


    public function email(){
        $form['id'] = Input::get_post('id','','intval');
        $form = $this->admin_user->info(['id'=>$form['id']]);
        $this->view->assign('form',$form);
        $this->view->display('admin/user/email/mail');
    }

    public function send_mail(){
        $form['id'] = Input::get_post('id','','intval');
        $email = Input::get_post('email');
        if(empty($email)){
            throw new LogicException(-100,'管理后台用户邮箱错误');
        }

        $user = $this->admin_user->find(['email'=>$email],'id,username,email');
        $email_code = $this->admin_user->email_code($user['id']);
        if(empty($form['id'])){
            $message = file_get_contents(APP_PATH.'views/admin/user/email/mail_login_template.php');
        }else{
            $message = file_get_contents(APP_PATH.'views/admin/user/email/mail_template.php');
        }
        $message = str_replace(['[email]','[email_code]'],[$email,$email_code],$message);



        $phpmail = new Email();
        $phpmail->addTo($email);
        $phpmail->Subject('管理后台用户邮箱绑定验证码');
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
        $email_code = $this->admin_user->email_code($form['id']);
        if($form_email_code!=$email_code){
            throw new LogicException(-100,'管理后台绑定验证码错误');
        }
        $form['email_status'] = 1;
        $form['admin_url'] = '';
        $res = $this->admin_user->update($form,['id'=>$form['id']]);
        if($res){
            Input::ajax_return(0,'管理后台用户绑定邮箱成功',$form);
        }else{
            Input::ajax_return(-100,'邮箱绑定失败',$form);
        }
    }

    public function login_weixin()
    {
        $callback_url = "http://mail.okfish.asia/user/login_weixin_return";
        $qrcode_url = (new WeixinLogin())->getKFLoginUrl($callback_url);
        echo $qrcode_url;
       // header("Location:".$qrcode_url);
        exit();

    }


    public function login_wexin_return(){
        $postStr = file_get_contents('php://input'); // 获取请求体

        //写入文件
        // file_put_contents('./uploads/weixin.log', $postStr."\r\n", FILE_APPEND); // 将信息追加到文件末尾
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        var_dump($postObj);
        $scene_id = $postObj->EventKey;

        $openid = $postObj->FromUserName;   //openid

        $ToUserName = $postObj->ToUserName;  //公众号

        $Event = strtolower($postObj->Event);   //事件类型

    }

}

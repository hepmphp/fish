<?php
/**
 *  fiename: fish/User.php$🐘
 *  date:  2024/11/4   22:59$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace bbs\controllers\web;

use app\helpers\Arr;
use bbs\base\exception\LogicException;
use app\helpers\Input;
use app\helpers\Session;
use app\helpers\Validate;
use app\helpers\VerifyCode;
use bbs\base\BbsController;
use bbs\models\Posts;
use bbs\models\User as M_User;
class User extends BbsController{
    public $posts= '';
    public function __construct()
    {
        $this->posts = new Posts();
        parent::__construct();
    }

    public function index(){
        $this->view->display('web/user/index');
    }

    public function register(){
        $avator_path = WEB_PATH.'/static/bbs/image/avator/*';
        $images = glob($avator_path);
        shuffle($images);
        $options = array();
        $image_list = array();
        foreach ($images as $k=>$image){
            // <option data-img-src="img/adnan.png">Adnan Sagar</option>
            $filename = basename($image);
            $url = STATIC_URL.'image/avator/'.$filename;
            $options[] = "<option value='{$filename}'>{$filename}</option>\n";
            if($k==0){
                $image_list[] = "<img src='{$url}' class='image' value='{$filename}' style='width:90px;height: 90px;' >\n";
            }else{
                $image_list[] = "<img src='{$url}' class='image'  value='{$filename}' style='width:90px;height: 90px;display: none' >\n";
            }

        }
        $this->view->assign('image_list',$image_list);
        $this->view->assign('options',$options);
        $this->view->display('web/user/register');
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
            $this->view->display('web/user/login');
        }
    }

    public function password(){
        if(Input::is_ajax()){
            $form['id'] = $_SESSION['bbs_user_id'];
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
            $this->view->display('web/user/password');
        }
    }

    public function info(){
        if(Input::is_ajax()){
            $form['id'] = $_SESSION['bbs_user_id'];
            $form['avator'] = Input::get_post('avator','','trim');
            if(!Validate::required($form['id'])){
                throw new LogicException(-1,'用户不存在');
            }
            $this->user->save($form);
        }else {

            $user_avator = $this->bbs_user['avator'];
            $avator_path = WEB_PATH.'/static/bbs/image/avator/*';
            $images = glob($avator_path);
            shuffle($images);
            $options = array();
            $image_list = array();
            foreach ($images as $k=>$image){
                // <option data-img-src="img/adnan.png">Adnan Sagar</option>
                $filename = basename($image);
                $selected  = '';
                if($filename==$user_avator){
                    $selected = 'selected';

                }
                $url = STATIC_URL.'image/avator/'.$filename;
                $options[] = "<option value='{$filename}' $selected>{$filename}</option>\n";
                if($k==0){
                    $image_list[] = "<img src='{$url}' class='image' value='{$filename}' style='width:90px;height: 90px;' >\n";
                }else{
                    $image_list[] = "<img src='{$url}' class='image'  value='{$filename}' style='width:90px;height: 90px;display: none' >\n";
                }

            }

            $this->view->assign('image_list',$image_list);
            $this->view->assign('options',$options);
            $this->view->display('web/user/info');
        }
    }

    public function logout(){
        Session::session_destroy();
        throw new LogicException(0,'退出成功');
    }

    public function find_password(){
        $this->view->display('web/user/find_password');
    }

    public function bbslist(){
        $data = [];
        $where = [];
        if(Input::get_post('user_id')){
            $where['user_id'] = Input::get_post( 'user_id','0','intval');
        }

        $page = Input::get_post('page','1','intval');
        $per_page = Input::get_post('per_page',20,'intval');
        $per_page = 3;
        list($res,$total) = $this->posts->get_list_info($where,$page,$per_page,'*');

        $user_ids = Arr::getColumn($res,'user_id');
        if(!empty($user_ids)){
            $where_user_id['id'] = $user_ids;
            $users = $this->user->find_all($where_user_id,1,1000);
            $user_index = Arr::index($users,'id');
            foreach ($res as $k=>$v){
                if(isset($user_index[$v['user_id']])){
                    $res[$k]['avator'] = $user_index[$v['user_id']]['avator'];
                }else{
                    $res[$k]['avator'] = '';
                }

            }
        }
        $data['list'] = $res;
        $data['total'] = $total;
        $data['page'] =$page;
        $data['per_page'] = $per_page;
        $this->view->assign('data',$data);
        $this->view->display('web/user/bbslist');
    }

}
<?php
/**
 *  fiename: fish/Log.php$🐘
 *  date:  2024/11/1   12:43$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\controllers\admin;

use app\base\BaseController;
use app\helpers\Input;
use app\models\curd\AdminLog;

class Log extends BaseController
{
    public $admin_log = '';
    public function __construct()
    {
        $this->admin_log = new AdminLog();
        parent::__construct();
    }

    public function index(){
        $this->view->display('admin/log/index');
    }

    public function info(){
        $form['id'] = Input::get_post('id','','intval');
        $form = $this->admin_log->info(['id'=>$form['id']]);
        $this->view->assign('form',$form);
        $this->view->display('admin/log/info');
    }

}
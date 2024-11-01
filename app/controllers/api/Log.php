<?php
/**
 *  fiename: fish/Category.php$🐘
 *  date:  2024/10/29   19:49$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\api;

use base\BaseController;
use base\exception\LogicException;
use helpers\Input;
use helpers\Validate;
use models\curd\AdminLog;

class Log extends BaseController{

    public $admin_log = '';

    public function __construct()
    {
        $this->admin_log = new AdminLog();
        parent::__construct();
    }

    public function get_search_where(){
        $where['user_id'] = Input::get_post('user_id','','intval');
        $where['username'] = Input::get_post('username','','trim');
        $start_time = Input::get_post('start_time');
        $end_time = Input::get_post('end_time');
        if(!empty($start_time)){
            $where['addtime>'] =strtotime($start_time);
        }
        if(!empty($end_time)){
            $where['addtime<'] = strtotime($end_time);
        }
        $where = array_filter($where);
        return $where;
    }

    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page');
        $per_page = Input::get_post('per_page',2);
        list($res,$total) = $this->admin_log->get_list_info($where,$page,$per_page,'*');
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
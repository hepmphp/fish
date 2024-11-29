<?php

namespace app\controllers\api\email;
use app\base\BaseController;
use app\base\exception\LogicException;
use app\helpers\email\MailTool;
use app\helpers\Input;

class Mail extends BaseController{

    public $mail_tool = '';
    public function __construct()
    {
        $this->mail_tool = new MailTool();
        parent::__construct();
    }

    public function get_search_where(){
        $subject = Input::get_post('subject','','trim');
        $where['subject'] = $subject;
        return $where;
    }

    public function index(){



    }

    public function create(){

    }

    public function update(){

    }

    public function delete(){

    }


    public function get_list(){
        $where = $this->get_search_where();
        $page = Input::get_post('page','1','intval');
        $per_page = Input::get_post('per_page',2,'intval');
        $data = $this->mail_tool->get_mail_lists($where,$page,$per_page);
        if($data){
            Input::ajax_return(0,'获取数据成功',$data);
        }else{
            throw new LogicException(100,'没有数据');
        }
    }
    public function info(){

    }



}
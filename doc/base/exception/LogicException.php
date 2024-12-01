<?php

namespace doc\base\exception;
use app\helpers\Input;
use doc\helpers\Msg;

class LogicException extends \Exception {
    public  $data;
    public function __construct($code=100,$msg='',$data='',\Exception $previous=null){
        $this->data = $data;
        if(Input::is_ajax()){
            if($msg){
                parent::__construct($msg,$code,$previous);
            }else{
                parent::__construct($msg,$code,$previous);
            }
        }else{
            if(!empty($_SERVER['HTTP_REFERER'])){
                if($code==0){
                    Msg::show_msg($msg,$_SERVER['HTTP_REFERER'],1);
                }else{
                    Msg::show_msg($msg,$_SERVER['HTTP_REFERER'],2);
                }
            }else{
                Msg::show_msg($msg,'/bbs.php',2);
            }


        }

    }
    public function get_data(){
        return $this->data;
    }

    public function get_name(){
        return 'LogicException';
    }

}
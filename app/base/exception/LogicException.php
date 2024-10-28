<?php
/**
 *  fiename: fish/LogicException.php$🐘
 *  date: 2024/10/19 18:55:46$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace base\exception;
class LogicException extends \Exception {
    public  $data;
    public function __construct($code=100,$msg='',$data='',\Exception $previous=null){
        $this->data = $data;
        if($msg){
            parent::__construct($msg,$code,$previous);
        }else{
            parent::__construct($msg,$code,$previous);
        }
    }
    public function get_data(){
        return $this->data;
    }

    public function get_name(){
        return 'LogicException';
    }

}
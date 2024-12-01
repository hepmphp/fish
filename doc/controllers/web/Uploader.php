<?php
/**
 *  fiename: fish/Uploader.php$🐘
 *  date:  2024/11/7   20:40$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace doc\controllers\web;

use doc\base\DocController;
use doc\helpers\FileUpload;
use app\helpers\Input;

class Uploader extends DocController{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        if(isset($_FILES)){
            $res = [];
            foreach ($_FILES as $file){
                $folder = '';
                $upload = new FileUpload();
                $res[] = $upload->upload($file);
            }
            Input::ajax_return(0,'',$res);
        }
    }
}
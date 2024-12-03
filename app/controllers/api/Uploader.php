<?php
/**
 *  fiename: fish/Uploader.php$🐘
 *  date:  2024/11/7   20:40$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\api;

use doc\base\DocController;
use app\helpers\FileUpload;
use app\helpers\Input;

class Uploader extends DocController{
    public function index(){
        if(Input::is_ajax() && isset($_FILES['file'])){
            $folder = Input::get_post('folder','','trim,strip_tags');
            $folder = str_replace('└','',$folder);
            $folder = str_replace(' ','',$folder);
            $upload = new FileUpload($folder);
            $res = $upload->upload();
            Input::ajax_return(0,'',$res);
        }
    }
}
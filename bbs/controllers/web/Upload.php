<?php
/**
 *  fiename: fish/Uploader.php$🐘
 *  date:  2024/11/7   20:40$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace bbs\controllers\web;

use app\helpers\FileUpload;
use app\helpers\Input;
use bbs\base\BbsController;

class Upload extends BbsController {
    public function index(){
        if(Input::is_ajax() && isset($_FILES['file'])){

            $upload = new FileUpload();
            $res = $upload->upload();
            Input::ajax_return(0,'',$res);
        }
    }
}
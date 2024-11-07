<?php
/**
 *  fiename: fish/Uploader.php$🐘
 *  date:  2024/11/7   20:40$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\api;

use app\base\BaseController;
use app\helpers\FileUpload;
use app\helpers\Input;

class Uploader extends BaseController{
    public function index(){
        if(Input::is_ajax() && isset($_FILES['file'])){
            $upload = new FileUpload();
            $res = $upload->upload();
            Input::ajax_return(0,'',$res);
        }
    }
}
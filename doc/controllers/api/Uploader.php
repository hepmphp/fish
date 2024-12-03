<?php
/**
 *  fiename: fish/Uploader.php$🐘
 *  date:  2024/11/7   20:40$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace doc\controllers\api;

use doc\base\DocController;
use doc\helpers\FileUpload;
use app\helpers\Input;

class Uploader extends DocController{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $is_mutil = Input::get_post('is_mutil');

        if(isset($_FILES)){
            $res = [];
            if($is_mutil){
                foreach ($_FILES as $file){
                    $folder = '';
                    $upload = new FileUpload();
                    $res[] = $upload->upload($file);
                }
            }else{
                $folder = '';
                $upload = new FileUpload();
                $res = $upload->upload($_FILES['file']);
            }
            Input::ajax_return(0,'',$res);
        }
    }
}
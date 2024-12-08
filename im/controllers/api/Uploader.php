<?php
/**
 *  fiename: fish/Uploader.php$🐘
 *  date:  2024/11/7   20:40$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace im\controllers\api;

use im\base\ImController;
use app\helpers\FileUpload;
use im\helpers\Input;

class Uploader extends ImController {
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
    /*
     *  code: 0, // 通常0表示成功
        msg: '文件上传成功',
        data: {
            src: fileUrl // 图片的URL
        }
     * **/
    public function layim(){
        if(Input::is_ajax() && isset($_FILES['file'])){
            $folder = Input::get_post('folder','','trim,strip_tags');
            $folder = str_replace('└','',$folder);
            $folder = str_replace(' ','',$folder);
            $upload = new FileUpload($folder);
            $res = $upload->upload();
            $api_res = $res;
            $api_res['src'] = $res['url'];
            Input::ajax_return(0,'',$api_res);
        }
    }
}
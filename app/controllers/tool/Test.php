<?php
/**
 *  fiename: fish/Test.php$🐘
 *  date:  2024/11/7   12:45$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\tool;

use app\base\BaseController;
use app\helpers\FileUpload;
use app\helpers\Input;

class Test extends BaseController{
    public function index(){
        if(Input::is_ajax() && isset($_FILES['file'])){
            $upload = new FileUpload();
            $res = $upload->upload();
            Input::ajax_return(0,'',$res);
        }else{
            $this->view->display('tool/test/index');
        }
    }


}
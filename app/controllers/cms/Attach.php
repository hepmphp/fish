<?php
/**
 *  fiename: fish/Attach.php$🐘
 *  date:  2024/10/29   19:34$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\cms;

use base\BaseController;

class Attach extends BaseController{
    public function index(){
        $this->view->display('cms/attach/index');
    }


}
<?php
/**
 *  fiename: fish/Captcha.php$🐘
 *  date:  2024/10/31   10:58$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace Bbs\controllers\web;


use bbs\base\BbsController;
use app\helpers\VerifyCode;

class Captcha extends BbsController
{
    public function get(){
        $captcha = new VerifyCode();
        $captcha->image();
    }


}





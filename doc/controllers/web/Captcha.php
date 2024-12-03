<?php
/**
 *  fiename: fish/Captcha.php$🐘
 *  date:  2024/10/31   10:58$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace doc\controllers\web;

use doc\base\DocController;
use app\helpers\VerifyCode;

class Captcha extends DocController
{
    public function get(){
        $captcha = new VerifyCode();
        $captcha->image();
    }


}





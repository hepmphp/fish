<?php
/**
 *  fiename: fish/Captcha.php$🐘
 *  date:  2024/10/31   10:58$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\controllers\api;


use app\base\BaseController;
use app\helpers\VerifyCode;

class Captcha extends BaseController
{


    public function get(){

        $captcha = new VerifyCode();
        $captcha->image();
    }


}





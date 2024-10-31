<?php
/**
 *  fiename: fish/Captcha.php$🐘
 *  date:  2024/10/31   10:58$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace controllers\api;


use base\BaseController;
use helpers\VerifyCode;

class Captcha extends BaseController
{
    public function index(){

    }

    public function get(){

        $captcha = new VerifyCode();
        $captcha->entry();
    }

    public function verify(){

    }



}





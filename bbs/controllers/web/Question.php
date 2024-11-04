<?php
/**
 *  fiename: fish/Question.php$🐘
 *  date:  2024/11/4   22:45$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace bbs\controllers\web;

use bbs\base\BbsController;
class Question extends BbsController{
    public function __construct()
    {

        parent::__construct();

    }

    public function index(){
        $this->view->display('web/question');

    }


}
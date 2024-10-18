<?php
/**
 *  fiename: fish/BaseController.php$🐘
 *  date: 2024/10/18 11:28:50$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace base;
abstract class BaseController{

    public  $app = null;

    protected $render_engine = 'php';

    protected $view;


    public function __construct() {
        $this->app = \base\App::get_instance(APP_PATH);
        $this->make_view();
    }

    protected function make_view() {
        if (!$this->render_engine) {
            return;
        }

        $view_path = APP_PATH.'/views/';
        if ($this->render_engine === 'Smarty') {
            $smarty_view          = new SmartyView($view_path);
            $this->view           = $smarty_view;
        } else {
            $this->view = new PhpView($view_path);
        }
    }


}
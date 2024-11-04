<?php
/**
 *  fiename: fish/PhpView.php$🐘
 *  date: 2024/10/18 11:22:39$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\base;
class PhpView implements ViewInterface {

    public $view_path = '';
    public $vars;

    public $view_file = '';
    public function __construct($view_path) {
        $this->view_path = $view_path;
    }
    public function assign($name, $value = null) {
//        if(empty($value)){
//            return $this;
//        }
        if (is_array($name)) {
            foreach ($name as $k => $v) {
                $this->vars[$k] = $v;
            }
        } else {
            $this->vars[$name] = $value;
        }

        return $this;
    }
    public function display($view_file) {
        $old_path = getcwd();
        chdir($this->view_path);
        if(!empty($this->vars)){
            extract($this->vars);
        }
        $this->view_file = $this->view_path."$view_file.php";
        include "$view_file.php";
        chdir($old_path);
    }
}
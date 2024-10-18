<?php
/**
 *  fiename: fish/PhpView.php$🐘
 *  date: 2024/10/18 11:22:39$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace base;
class PhpView implements ViewInterface {

    protected $view_path = '';
    protected $vars;

    public function __construct($view_path) {
        $this->view_path = $view_path;
    }


    public function assign($name, $value = null) {
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
        include "$view_file.php";
        chdir($old_path);
    }
}
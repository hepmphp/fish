<?php
/**
 *  fiename: fish/ViewInterface.php$🐘
 *  date: 2024/10/18 11:21:27$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace base;

Interface ViewInterface {
    public function assign($name,$value=null);
    public function display($view_file);
}
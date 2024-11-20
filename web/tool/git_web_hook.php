<?php
/**
 *  fiename: fish/git_web_hook.php$🐘
 *  date:  2024/11/19   23:33$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
$git_path = isset($_GET['git_path'])?$_GET['git_path']:'fish';
var_dump($git_path);
passthru("sh ./git-hook.sh $git_path");
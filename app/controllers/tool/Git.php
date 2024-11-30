<?php
/**
 *  fiename: fish/Git.php$🐘
 *  date:  2024/11/30   0:04$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\controllers\tool;
use app\helpers\Input;

class Git extends \app\base\BaseController{

    public function index(){
        $this->view->display('tool/git/index');
    }

    public function command(){
        $cmd = Input::get_post('cmd');
        $path = Input::get_post('path','','trim');
        $cmd_shells = [];
        $cmd = explode(',',$cmd);
        $cmd = array_filter($cmd);
        // create repo object
        if(is_array($cmd)){
            foreach ($cmd as $cmd_linux)
                $cmd_shells[] = 'cd '.$path.' && sudo '.$cmd_linux;
        }else{
            $cmd_shells[]  =  'cd '.$path.' && sudo '.$cmd;
        }
        foreach ($cmd_shells as $cmd_shell){
            exec($cmd_shell,$output,$return);
        }

        if($return==0){
            $output['msg'] = 'success';
            Input::ajax_return(0,['cmd'=> $cmd],$output);
        }else{
            $output['msg'] = '执行'.$cmd.'失败';
            $output['cmd'] = $cmd;
            Input::ajax_return(-100,$output);
        }


    }
}
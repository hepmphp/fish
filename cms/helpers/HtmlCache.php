<?php
/**
 *  fiename: fish/HtmlCache.php$🐘
 *  date:  2024/11/4   10:22$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace cms\helpers;

use cms\base\Url;

class HtmlCache{
    public $file_cahe_html_path = WEB_PATH.'/html/';
    public $view = '';
    public $view_file='';
    public $file_html = '';
    public function __construct($view,$config)
    {
        $this->view = $view;
        $url = new Url($config['routers']);
        list($path,$class,$method) = $url->parse_path_class_method();
        $class_arr = explode('\\',$class);
        $class_name = end($class_arr);
        $class_name = strtolower($class_name);
        $this->view_file = "{$path}/{$class_name}";
        $this->file_html = "$this->file_cahe_html_path$class_name/".str_replace('/','_',$this->view_file).'_'.md5(implode('',$_GET)).".html";

        if(!is_dir("$this->file_cahe_html_path$class_name")){
            mkdir("$this->file_cahe_html_path$class_name",0755,true);
        }
    }

    public function start(){
        /*静态页面获取开始*/
        if(file_exists($this->file_html)){
            echo file_get_contents($this->file_html);
            exit();
        }
        /*静态页面获取结束*/
    }

    public function end(){
        /*静态页面生成开始*/
        extract($this->view->vars);
        $view_file_php = $this->view->view_path."$this->view_file.php";
        ob_start();
        include  $view_file_php;
        $html = ob_get_contents();
        ob_end_clean();
        $filemd5 = md5($html);
        if(file_exists($this->file_html)){
            $old_file_md5 = md5_file($this->file_html);
            if(!$old_file_md5==$filemd5){
                file_put_contents($this->file_html,$html);
            }
        }else{
            file_put_contents($this->file_html,$html);
        }
        /*静态页面生成结束*/
    }
}
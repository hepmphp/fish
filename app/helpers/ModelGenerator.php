<?php
/**
 *  fiename: fish/ModelGenerator.php$🐘
 *  date: 2024/10/18 18:17:51$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace helpers;
use base\App;
use helpers\InfoSchema;

class ModelGenerator
{
    public $model_path = APP_PATH.'/models/curd/';
    public function __construct(){
        if(!is_dir($this->model_path)){
            mkdir($this->model_path,0755,true);
        }
    }
    public function generator_model(){
        $info_schema = new InfoSchema('ultrax');
        $sql = $info_schema->get_table();
        $db = App::get_db();
        $data = $db->fetch_all($sql);
       // Msg::dump($data);
        foreach ($data as $k=>$v){
            $model_template = file_get_contents(APP_PATH.'models/template/Users.php.tpl');
            $tbname = explode('_',$v['id']);
            unset($tbname[0]);
            $tbname = array_map(function ($val){
                    return ucwords($val);
            },$tbname);
            $tbname = implode('',$tbname);
            var_dump($tbname);
            $template = str_replace(array('[Users]','[t]','[p]'),array(str_replace('/','',$tbname),$v['id'],''),$model_template);
            $template = $template.PHP_EOL.'##生成时间:'.date('Y-m-d H:i:s').' 文件路径：'.$this->model_path.$tbname.'.php🐘';
            file_put_contents($this->model_path.'/'.$tbname.'.php',$template);
            highlight_string($template);
          //  echo $template;

        }
    }

}
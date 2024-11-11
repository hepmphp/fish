<?php
/**
 *  fiename: fish/Url.php$🐘
 *  date:  2024/10/30   1:32$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace cms\base;

use app\helpers\Input;

class Url
{
    public $config = array();

    public function __construct($config){
        $this->config = $config;
    }

    public function parse_routes(){
        $routers = $this->config;
        if(empty($routers)){
            return array();
        }
        $parse_route = '';
        foreach($routers as $rule=>$route){
            //默认没有路由的情况解析
            $parse_route = parse_url($_SERVER['REQUEST_URI']);

            $_SERVER['PATH_INFO'] = $parse_route['path'];
            if(isset($parse_route['query'])){
                $_SERVER['QUERY_STRING'] = $parse_route['query'];
                parse_str($parse_route['query'],$_GET);//解析路由配置参数填充到$_GET参数
                parse_str($parse_route['query'],$_REQUEST);//解析路由配置参数填充到$_REQUEST

                break;
            }
            // Convert wild-cards to RegEx
            $rule = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $rule));
            // Does the RegEx match?
            if (isset($_SERVER['PATH_INFO']) && preg_match('#'.$rule.'$#', $_SERVER['PATH_INFO'],$matchRule))
            {
                if (strpos($route, '$') !== FALSE AND strpos($rule, '(') !== FALSE)
                {
                    foreach($matchRule as $key=>$m_rule){
                        if($key==0)continue;
                        $route =  str_replace('$'.$key,$m_rule,$route);
                    }
                }
                $parse_route = parse_url($route);
                $_SERVER['PATH_INFO'] = $parse_route['path'];
                if(isset($parse_route['query'])){
                    $_SERVER['QUERY_STRING'] = $parse_route['query'];
                    parse_str($parse_route['query'],$_GET);//解析路由配置参数填充到$_GET参数
                    parse_str($parse_route['query'],$_REQUEST);//解析路由配置参数填充到$_REQUEST
                }
            }
        }
    }
    public function parse_path_info(){
        $path_info = isset($_SERVER['PATH_INFO'])&&!empty($_SERVER['PATH_INFO'])?explode('/',$_SERVER['PATH_INFO']):array($this->config['const']['DEFAULT_CONTROLLER']);
        /**g分组 m控制器 a方法*/
        $g = Input::get('g');
        $m = Input::get('m');
        $a = Input::get('a');
        if($m&&$a){
            $path_info = array();
            $path_info[] = $g;
            $path_info[] = $m;
            $path_info[] = $a;
        }
        return $path_info;
    }

    public function parse_path_class_method(){
        $this->parse_routes();//路由解析
        $path_info = $this->parse_path_info();
        $path_info = array_values(array_filter($path_info));
        foreach ($path_info as $k => $p) {
            if (strpos($p, '.php') !== -1) {
                $path_info[$k] = str_replace('.php', '', $p);
            }
        }
        $path = '';
        $method = '';
        if (count($path_info)==4){
            list($path_index,$path_detail,$class,$method) = $path_info;
            $path = $path_index.'\\'.$path_detail;
        }else if(count($path_info)==3){
            list($path,$class,$method) = $path_info;
        }else if(count($path_info)==2){
            list($class,$method) = $path_info;
        }else{
            $class = is_array($path_info)&&empty($path_info)?'':$path_info[0];
            $method = 'index';
        }
       $class=!empty($class)?$class:'Index';
        if(empty($path)){
            $class = '\\cms\\controllers\\web\Index';
            $path = "web";
        }else{
            $class = ucwords($class,'_,-');
            if(strpos($class,'_')!==false OR strpos($class,'-')!==false){
                $class = str_replace(array('_','-'),array('',''),$class);
            }
            $class = "\\cms\\controllers\\{$path}\\".$class;
        }
        return [$path,$class,$method];
    }
}
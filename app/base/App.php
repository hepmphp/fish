<?php
/**
 *  fiename: fish/App.php$
 *  date: 2024/10/17 22:19:40$
 *  author: hepm<ok_fish@qq.com>$
 */

namespace base;
use db\PdoHelper;
use helpers\Input;

class App
{
    protected static $instance;
    protected static $db;
    public static $config;
    public $app_path;
    public $path;
    public $controller;
    public $action;

    static function get_instance($app_path=''){
        if(empty(self::$instance)){
            self::$instance = new self($app_path);
        }
        return self::$instance;
    }
    static function get_db($instance='master'){
       $master = new PdoHelper(self::$config['database'][$instance]);
        if(empty(self::$db[$instance])){
            self::$db[$instance] = $master;
        }
        return self::$db[$instance];
    }

    public function __construct($app_path)
    {
        $this->app_path = $app_path;
        self::$config = new Config($app_path.'configs');

    }

    public function run(){
        $this->handle_error_and_exception();
        $this->init_dependences();
        $this->dispatch();

    }

    public function init_dependences(){
        //::todo
        //db
        //session
        //redis
    }

    public function handle_error_and_exception(){
//        set_exception_handler('helpers\Handler','exception_handler');
//        set_error_handler(array('helpers\Handler','error_handler'));
//        register_shutdown_function(array('helpers\Handler','shutdown_handler'));
    }

    public function dispatch(){
        $this->_parse_routes();//路由解析
        $path_info = $this->_parse_path_info();
        $path_info = array_values(array_filter($path_info));

        $path = '';
        $method = '';
        if(count($path_info)==3){
            list($path,$class,$method) = $path_info;
        }else if(count($path_info)==2){
            list($class,$method) = $path_info;
        }else{
            $class = $path_info[0];
            $method = 'index';
        }
        $this->controller = $class?$class:'welcome';
        if(empty($path)){
            $class = '\\controllers\\fish\Welcome';
        }else{
            $class = ucwords($class);
            $class = "\\controllers\\{$path}\\".$class;
        }

        $this->path = $path;
        $controller = new $class;
        if(method_exists($controller,$method)){
            $this->action = $method;
            return $controller->$method();
        }else{
            throw new \Exception("{$class} has not method {$method}");
        }
    }

    public function _parse_routes(){
        $routers = self::$config['routers'];
        if(empty($routers)){
            return array();
        }

        $parse_route = '';
        foreach($routers as $rule=>$route){
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

    public function _parse_path_info(){
        $path_info = isset($_SERVER['PATH_INFO'])&&!empty($_SERVER['PATH_INFO'])?explode('/',$_SERVER['PATH_INFO']):array(self::$config['const']['DEFAULT_CONTROLLER']);
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




}
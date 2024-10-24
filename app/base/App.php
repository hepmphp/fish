<?php
/**
 *  fiename: fish/App.php$
 *  date: 2024/10/17 22:19:40$
 *  author: hepm<ok_fish@qq.com>$
 */

namespace base;
use db\PdoHelper;
use helpers\Handler;
use helpers\Input;
use helpers\Msg;

class App
{
    protected static $instance=null;
    protected static $db =null;
    public static $config=array();
    public $app_path='';
    public $path='';
    public $controller='';
    public $method='';

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

        set_error_handler(function ($errno,$errstr,$errfile='',$errline='',$errcontext=array()){
            $errcode = Handler::$levels[$errno];
            $log_message = "错误代码:[%s],错误信息:[%s],文件:[%s],行号:[%d],地址:[%s],来源:[%s]";
            $url     = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $referer = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
            $log_message_format = sprintf($log_message,$errcode,$errstr,$errfile,$errline,$url,$referer);
            echo( json_encode( array('status' =>$errno,'msg'  =>$log_message_format),JSON_UNESCAPED_UNICODE));
        });
        set_exception_handler(function ($exception){
            echo( json_encode( array('status' =>$exception->getCode(),'msg'  =>$exception->getMessage()),JSON_UNESCAPED_UNICODE));
        });

        register_shutdown_function(array('helpers\Handler','shutdown_handler'));
    }

    public function dispatch(){
        $this->_parse_routes();//路由解析
        $path_info = $this->_parse_path_info();
        $path_info = array_values(array_filter($path_info));
        $path = '';
        $class_method = '';
        if(count($path_info)==3){
            list($path,$class,$class_method) = $path_info;
        }else if(count($path_info)==2){
            list($class,$class_method) = $path_info;
        }else{
            $class = is_array($path_info)&&empty($path_info)?'':$path_info[0];
            $class_method = 'index';
        }
        $this->controller = $class?$class:'user';
        if(empty($path)){
            $class = '\\controllers\\admin\user';
        }else{
            $class = ucwords($class);
            $class = "\\controllers\\{$path}\\".$class;
        }
        $dir_file = WEB_PATH."\\..\\app".$class.'.php';
        if(file_exists($dir_file)){
            $this->path = $path;
            $controller = new $class;
            if(method_exists($controller,$class_method)){

                $this->method = $class_method;
                $controller->$class_method();
            }else{
                throw new \Exception("{$class} has not method {$class_method}");
            }
        }
    }

    public function _parse_routes(){

        $routers = self::$config['routers'];
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
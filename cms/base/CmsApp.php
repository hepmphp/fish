<?php
/**
 *  fiename: fish/App.php$
 *  date: 2024/10/17 22:19:40$
 *  author: hepm<ok_fish@qq.com>$
 */

namespace cms\base;
use base\exception\LogicException;
use db\PdoHelper;
use base\Config;
use base\Url;
use helpers\Input;
use helpers\Msg;
use helpers\Session;
use helpers\Handler;

class CmsApp
{
    public static $instance=null;
    public static $db =null;
    public static $config=array();
    public $middleware = array();
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
        Session::init();
        //redis
        //event
//        Event::attach('app');
    }

    public function handle_error_and_exception(){

            set_error_handler(function ($errno,$errstr,$errfile='',$errline='',$errcontext=array()){
                $time = date("Y-m-d H:i:s");

                $log_message = "错误代码:[%s],错误信息:[%s],文件:[%s],行号:[%d],地址:[%s],来源:[%s]";
                $url     = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                $referer = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
                $log_message_format = $time."|".sprintf($log_message,-100,$errstr,$errfile,$errline,$url,$referer);

                print_r($log_message_format);
                exit();

            });
            set_exception_handler(function ($exception){
                echo( json_encode( array('status' =>$exception->getCode(),'msg'  =>$exception->getMessage()),JSON_UNESCAPED_UNICODE));
            });
    }

    public function dispatch()
    {
        $url = new Url(self::$config['routers']);

        $url->parse_routes();//路由解析
        $path_info = $url->parse_path_info();

        $path_info = array_values(array_filter($path_info));
        foreach ($path_info as $k => $p) {
            if (strpos($p, '.php') !== -1) {
                $path_info[$k] = str_replace('.php', '', $p);
            }
        }

        $path = '';
        $class_method = '';
        if (count($path_info)==4){
            list($path_index,$path_detail,$class,$class_method) = $path_info;
            $path = $path_detail;
        }else if(count($path_info)==3){
            list($path,$class,$class_method) = $path_info;
        }else if(count($path_info)==2){
            list($class,$class_method) = $path_info;
        }else{
            $class = is_array($path_info)&&empty($path_info)?'':$path_info[0];
            $class_method = 'index';
        }
        $this->controller = $class?$class:'user';

        if(empty($path)){
            $class = '\\cms\\controllers\\web\index';
        }else{
            $class = ucwords($class,'_,-');
            if(strpos($class,'_')!==false OR strpos($class,'-')!==false){
                $class = str_replace(array('_','-'),array('',''),$class);
            }
            $class = "\\cms\\controllers\\{$path}\\".$class;
        }

        $dir_file = WEB_PATH."\\..".$class.'.php';

        if(file_exists($dir_file)){
            $this->path = $path;
            $controller = new $class;

            if(method_exists($controller,$class_method)){
                $this->method = $class_method;
//                $next = function (){};
//                $this->middleware = new Middleware(self::$instance);
//                $this->middleware->register_middleware([SessionMiddleware::class,AuthMiddleware::class,CsrfMiddleware::class],[LogMiddleware::class]);
//                $this->middleware->run_middleware($next);
                $controller->$class_method();
//                if (function_exists('fastcgi_finish_request')) {
//                    fastcgi_finish_request();//主动flush数据给nginx
//                }
                //$this->middleware->run_after_middleware($next);
            }else{
                throw new \Exception("{$class} has not method {$class_method}");
            }
        }
    }
}
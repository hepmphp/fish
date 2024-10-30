<?php
/**
 *  fiename: fish/App.php$
 *  date: 2024/10/17 22:19:40$
 *  author: hepm<ok_fish@qq.com>$
 */

namespace base;
use base\exception\LogicException;
use base\middleware\SessionMiddleware;
use base\middleware\LogMiddleware;
use db\PdoHelper;
use helpers\Handler;
use base\middleware\AuthMiddleware;
use base\middleware\Log;
use helpers\Input;
use helpers\Msg;
use helpers\Session;

class App
{
    protected static $instance=null;
    protected static $db =null;
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
        $url = new Url(self::$config['routers']);
        $url->parse_routes();//路由解析
        $path_info = $url->parse_path_info();
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
            $class = ucwords($class,'_,-');
            if(strpos($class,'_')!==false OR strpos($class,'-')!==false){
                $class = str_replace(array('_','-'),array('',''),$class);
            }
            $class = "\\controllers\\{$path}\\".$class;
        }
        $dir_file = WEB_PATH."\\..\\app".$class.'.php';

        if(file_exists($dir_file)){
            $this->path = $path;
            $controller = new $class;
            if(method_exists($controller,$class_method)){
                $this->method = $class_method;
                $next = function (){};
                $this->middleware = new Middleware(self::$instance);
                $this->middleware->register_middleware([SessionMiddleware::class,AuthMiddleware::class],[LogMiddleware::class]);
                $this->middleware->run_middleware($next);
                $controller->$class_method();
                $this->middleware->run_after_middleware($next);
            }else{
                throw new \Exception("{$class} has not method {$class_method}");
            }
        }
    }
}
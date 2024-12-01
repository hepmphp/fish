<?php
/**
 *  fiename: fish/App.php$
 *  date: 2024/10/17 22:19:40$
 *  author: hepm<ok_fish@qq.com>$
 */
namespace doc\base;
use app\db\PdoHelper;
use app\base\Config;
use app\helpers\Session;

class DocApp
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
        Session::init();
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


        list($path,$class,$method) = $url->parse_path_class_method();
        $class_file = WEB_PATH."\\..".$class.'.php';
        $class_file = str_replace('\\','/',$class_file);
        if(file_exists($class_file)){
            $controller = new $class;
            if(method_exists($controller,$method)){
                $this->path = $path;
                $this->controller = $class;
                $this->method = $method;

//                $next = function (){};
//                $this->middleware = new Middleware(self::$instance);
//                $this->middleware->register_middleware([SessionMiddleware::class,AuthMiddleware::class,CsrfMiddleware::class],[LogMiddleware::class]);
//                $this->middleware->run_middleware($next);
                $controller->$method();
//                if (function_exists('fastcgi_finish_request')) {
//                    fastcgi_finish_request();//主动flush数据给nginx
//                }
                //$this->middleware->run_after_middleware($next);
            }else{
                throw new \Exception(-100,"{$class} has not method {$method}");
            }
        }
    }
}
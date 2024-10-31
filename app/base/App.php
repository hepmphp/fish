<?php
/**
 *  fiename: fish/App.php$
 *  date: 2024/10/17 22:19:40$
 *  author: hepm<ok_fish@qq.com>$
 */

namespace base;
use base\exception\LogicException;
use db\PdoHelper;
use base\middleware\AuthMiddleware;
use base\middleware\SessionMiddleware;
use base\middleware\LogMiddleware;
use base\middleware\CsrfMiddleware;
use helpers\Input;
use helpers\Msg;
use helpers\Session;
use helpers\Handler;

class App
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
        Event::attach('app');
    }

    public function handle_error_and_exception(){
        $hanlder = new Handler();
        $hanlder->register();
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
                $this->middleware->register_middleware([SessionMiddleware::class,AuthMiddleware::class,CsrfMiddleware::class],[LogMiddleware::class]);
                $this->middleware->run_middleware($next);
                $controller->$class_method();
//                if (function_exists('fastcgi_finish_request')) {
//                    fastcgi_finish_request();//主动flush数据给nginx
//                }
                $this->middleware->run_after_middleware($next);
            }else{
                throw new \Exception("{$class} has not method {$class_method}");
            }
        }
    }
}
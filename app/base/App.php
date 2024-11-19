<?php
/**
 *  fiename: fish/App.php$
 *  date: 2024/10/17 22:19:40$
 *  author: hepm<ok_fish@qq.com>$
 */

namespace app\base;
use app\base\exception\LogicException;
use app\db\PdoHelper;
use app\base\middleware\AuthMiddleware;
use app\base\middleware\SessionMiddleware;
use app\base\middleware\LogMiddleware;
use app\base\middleware\CsrfMiddleware;
use app\helpers\Input;
use app\helpers\Msg;
use app\helpers\Session;
use app\helpers\Handler;

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
        list($path,$class,$method) = $url->parse_path_class_method();
        $class_file = WEB_PATH."\\..".$class.'.php';
        $class_file = str_replace('\\','/',$class_file);

        if(file_exists($class_file)){
            $controller = new $class;
            if(method_exists($controller,$method)){
                $this->path = $path;
                $this->controller = $class;
                $this->method = $method;
                $next = function (){};
                $this->middleware = new Middleware(self::$instance);
                $this->middleware->register_middleware([SessionMiddleware::class,AuthMiddleware::class,CsrfMiddleware::class],[LogMiddleware::class]);
                $this->middleware->run_middleware($next);

                $controller->$method();
//                if (function_exists('fastcgi_finish_request')) {
//                    fastcgi_finish_request();//主动flush数据给nginx
//                }
                $this->middleware->run_after_middleware($next);
            }else{
                throw new \Exception("{$class} has not method {$method}");
            }
        }
    }
}
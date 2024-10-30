<?php
error_reporting(E_ALL);
/**
 *  fiename: fish/Test.php$🐘
 *  date:  2024/10/30   9:51$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
/**
前置中间件：
cookie验证：验证用户的cookie
用户角色验证：定义不同的用户角色并验证
用户权限验证：配置不同的用户权限，并验证
安全相关，如CSRF校验：CSRF校验中间件
http方法过滤：过滤特定的GET POST请求
http或者page cache：对指定路径的页面进行缓存
跨域中间件：不用在nginx配置，而是通过框架的方式，针对某些域名或某些请求，提供跨域的服务。
后置中间件：
共同数据输出：针对统一业务的公共数据，在后置中统一输出
请求返回浏览器之后的中间件：
打印日志
更新session（Laravel）
 */
//$app = function ($name){
//    echo "{$name} 项目业务逻辑\n";
//};
//
//$middleware = function ($handler){
//    return function ($name) use($handler){
//        echo "{$name} 项目代码执行前的校验代码\n";
//        return $handler($name);
//    };
//};
//
//$middleware1 = function ($handler){
//    return function ($name) use($handler){
//        echo "{$name} 项目代码执行前的校验代码1\n";
//        return $handler($name);
//    };
//};
//
//$middleware3 = function($handler) {
//    return function($name) use ($handler) {
//        $return = $handler($name);//重点是这，先执行前置中间件代码和核心应用代码
//        echo "{$name}项目代码执行后的日志记录代码3<br />";
//        return $return;
//    };
//};
//
//function register_middleware($handler,$middleware_arr){
//    $middleware_arr = array_reverse($middleware_arr);
//    foreach ($middleware_arr as$middleware){
//        $handler = $middleware($handler);
//    }
//    return $handler;
//}
//$run = register_middleware($app,[$middleware,$middleware1,$middleware3]);
//$run('hello');

class Middleware {
    public $middlewares = array();
    public $middlewares_after = array();
    public $handler = array();
    public function __construct($handler){
        $this->handler = $handler;
    }
    public function register_middleware($middleware,$middleware_after=array()){
        $this->middlewares = $middleware;
        $this->middlewares_after = $middleware_after;
    }
    public function run_middleware($next=''){
        $this->middlewares = array_reverse($this->middlewares);
        foreach ($this->middlewares as$middleware){
                $middleware_instance = new $middleware;
                $middleware_instance->handle($this->handler,$next);
        }
    }
    public function run_after_middleware($next=''){
        $this->middlewares_after = array_reverse($this->middlewares_after);

        foreach ($this->middlewares_after as$middleware){
            $middleware_instance = new $middleware;
            $middleware_instance->handle($this->handler,$next);
        }
    }
}

class Filter{
    public function handle($handler,$next){
        echo date('Y-m-d H:i:s').__CLASS__."\n";
        return $next($handler);
    }
}
class Auth{
    public function handle($handler,$next){
        echo date('Y-m-d H:i:s').__CLASS__."\n";
        return $next($handler);
    }
}
class Log{
    public function handle($handler,$next){
        echo date('Y-m-d H:i:s').__CLASS__."\n";
        return $next($handler);
    }
}

class Format{
    public function handle($handler,$next){
        echo date('Y-m-d H:i:s').__CLASS__."\n";
        return $next($handler);
    }
}
class App{
    public function run(){
        $middleware = new Middleware($this);
        $middleware->register_middleware([Filter::class,Auth::class],[Log::class,Format::class]);
        $next = function (){};
        $middleware->run_middleware($next);
        echo 'app controller method call...'.PHP_EOL;
        $middleware->run_after_middleware($next);
    }

}


$app = new App();
$app->run();
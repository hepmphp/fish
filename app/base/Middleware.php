<?php
/**
 *  fiename: fish/Middleware.php$🐘
 *  date:  2024/10/30   11:13$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace base;
class Middleware {
    public $middlewares = array();
    public $middlewares_after = array();
    public $handler = array();
    public function __construct($handler){
        $this->handler = $handler;
    }

    /***
     * 注册中间件
     * @param $middleware
     * @param array $middleware_after
     */
    public function register_middleware($middleware,$middleware_after=array()){
        $this->middlewares = $middleware;
        $this->middlewares_after = $middleware_after;
    }

    /***
     * 执行中间件
     * @param string $next
     */
    public function run_middleware($next=''){
        $this->middlewares = array_reverse($this->middlewares);
        foreach ($this->middlewares as$middleware){
            $middleware_instance = new $middleware;
            $middleware_instance->handle($this->handler,$next);
        }
    }

    /***
     * 执行后中间件
     * @param string $next
     */
    public function run_after_middleware($next=''){
        $this->middlewares_after = array_reverse($this->middlewares_after);

        foreach ($this->middlewares_after as$middleware){
            $middleware_instance = new $middleware;
            $middleware_instance->handle($this->handler,$next);
        }
    }
}
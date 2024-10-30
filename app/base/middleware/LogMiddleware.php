<?php
/**
 *  fiename: fish/Log.php$🐘
 *  date:  2024/10/30   11:17$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace base\middleware;
use helpers\Log;
class LogMiddleware{
    public function handle($handler,$next){
       // echo date('Y-m-d H:i:s').__CLASS__."\n";
        Log::write(var_export($_REQUEST,true));
        return $next($handler);
    }
}
<?php
/**
 *  fiename: fish/Time.php$
 *  date: 2024/10/17 21:59:10$
 *  author: hepm<ok_fish@qq.com>$
 */

namespace app\helpers;

class Timer
{
    /**
     * 时间
     * @var array $_timer Collection of timers
     */
    private static $_timer = array();
    /**
     * 内存
     * @var array
     */
    private static $_mem = array();
    /**
     * 开始检测
     * start - Start a timer
     *
     * @param string $id The id of the timer to start
     */
    public static function start($id)
    {
        if (isset(self::$_timer[$id]))
            throw new \Exception("Timer already set: $id");
        self::startTime($id);
        self::startMem($id);
    }
    /**
     * 开始时间
     * @param $id
     */
    public static function startTime($id)
    {
        self::$_timer[$id] = self::microtime();
    }
    /**开始内存检测
     * @param $id
     */
    public static function startMem($id)
    {
        self::$_mem[$id] = memory_get_usage();
    }
    /**结束时间
     * @param $id
     */
    public static function endTime($id)
    {
        $totalTime = self::microtime() - self::$_timer[$id];
        $totalTimeStr = sprintf('耗时: %.9f s ', $totalTime);
        return $totalTimeStr;
    }
    /**结束内存检测
     * @param $id
     */
    public static function endMem($id)
    {
        $endMem = memory_get_usage();
        $memUsed = $endMem - self::$_mem[$id];
        $memUsedStr = sprintf('内存消耗: %01.9f MB', $memUsed / 1024 / 1024);
        return $memUsedStr;
    }
    /**
     * 结束检测
     * stop - Stop a timer
     *
     * @param string $id The id of the timer to stop
     */
    public static function stop($id)
    {
        $filename = 'debug';
        $type = 'debug';
        $html = "debug_start.........................................................................................................................................................\n".
            self::endTime($id).
            self::endMem($id)."\n".
            print_r(\app\helpers\Debuger::last_log(),true)."\n".
            Debuger::print_include_files()."\n".
            Debuger::print_stack_trace()."\n".
            "debug_end.........................................................................................................................................................\n";
        Log::file_put_contents($html,$filename,$type);
    }
    /**
     * get microtime float
     */
    public static function microtime()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
    /**
     * 直接检测调用go的开始行到文件结尾的时间和内存消耗
     * @param $id
     */
    public static function go($id)
    {
       // if(isset($_SERVER['PATH_INFO'])  && ($_SERVER['PATH_INFO']!='/tool/log/index' ||  $_SERVER['PATH_INFO']!='/admin/user/logout')){
            self::start($id);
            register_shutdown_function('\\app\\helpers\\Timer::stop',$id);
       // }
    }
}
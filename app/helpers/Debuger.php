<?php
/**
 *  fiename: fish/Debug.php$
 *  date: 2024/10/17 21:45:03$
 *  author: hepm<ok_fish@qq.com>$
 */

namespace helpers;

class Debuger
{


    public static function last_log()
    {
        $last_log = array(
            '$_GET' => print_r($_GET, true),
            '$_POST' => print_r($_POST, true),
            '$_SERVER' => print_r($_SERVER, true),
            '$_COOKIE' => print_r($_COOKIE, true),
            '$_FILES' => var_export($_FILES, true),
            '$_ENV' => print_r($_ENV, true),
            '$_SESSION' => isset($_SESSION) ? print_r($_SESSION, true) : '',
            //'$GLOBALS'=>var_export($GLOBALS,true)
        );
        return $last_log;
    }

    static function debug_print_backtrace()
    {

        echo "<pre>";
        echo "<hr/>";
        debug_print_backtrace();
        print_r(debug_backtrace());
    }

    /**
     * 打印调用
     */
    static function print_stack_trace()
    {
        $e = new \Exception();
        echo "<pre>";
        print_r(str_replace('/path/to/code/', '', $e->getTraceAsString()));
    }

    /*
     * 打印被包含的文件
     */
    static function print_include_files()
    {
        echo "<pre>";
        print_r(get_included_files());
    }

    static function db_log($sql)
    {
        $message = date('[Y-m-d H:i:s]') . '  ' . $sql;
        error_log($message . PHP_EOL, 3, WEB_PATH . '/log/model_db_sql.log');
    }

    static function console_log_table($data)
    {
        if (!is_array($data) and empty($data)) {
            return true;
        }
        $data_json = json_encode($data, JSON_UNESCAPED_SLASHES);
        $message = <<<EOT
<script>
        console.table($data_json);
</script>        
EOT;
        file_put_contents(WEB_PATH . '/log/console_log_table.log', $message . PHP_EOL);
        return $message;

    }

    static function console_log($data)
    {
        if (!is_array($data) and empty($data)) {
            return true;
        }
        $message = '';
        $message_append = '';
        $log = array(
            'HTTP_HOST' => $_SERVER['HTTP_HOST'],
            'REQUEST_URI' => $_SERVER['REQUEST_URI'],
            'DOCUMENT_URI' => $_SERVER['DOCUMENT_URI'],
        );
        $log = $log + $_GET + $_POST;
        $log = json_encode($log, JSON_UNESCAPED_SLASHES);
        $message_append = <<<EOT
<script>
            var log_con = $log    
            console.group('php.http.request');
            console.table(log_con);
            console.groupEnd('php.http.request');
</script>
EOT;

        foreach ($data as $k => $v) {
            $images = '🐘' . date('[Y-m-d H:i:s] ') . 'mysql>' . ($k+1) . '';
            $message = $message . <<<EOT
<script>
        console.log("%c $images %c $v", 
         'background: #13212E; color: #FFF; border-radius: 3px 0 0 3px; padding: 5px 10px;',
         'background: #41b883; border-radius: 0 3px 3px 0;color: #13212E; padding: 5px 10px;font-size: 12px;'
         );
</script>
EOT;
        }
        file_put_contents(WEB_PATH . '/log/console_log.log', $message . $message_append . PHP_EOL);
        return $message . $message_append;

    }

}



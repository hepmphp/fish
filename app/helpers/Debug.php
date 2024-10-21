<?php
/**
 *  fiename: fish/Debug.php$
 *  date: 2024/10/17 21:45:03$
 *  author: hepm<ok_fish@qq.com>$
 */

namespace helpers;

class Debug
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

    static function console_log_table($data){
        return true;
        if(Input::is_ajax() OR Input::is_post()){
            return true;
        }
        $data_json = json_encode($data, JSON_UNESCAPED_SLASHES);
        $message = <<<EOT
<script> 
        console.table($data_json)
</script>
EOT;
        echo $message;

    }
    static function console_log($data)
    {
        return true;
        if(Input::is_ajax() OR Input::is_post()){
            return true;
        }
        static $count;
        $count++;
        $images = '🐘' . date('[Y-m-d H:i:s] ') . 'mysql>' . $count.'';
        $message = <<<EOT
        <script> 
        console.log(`%c $images %c $data`, 
         'background: #13212E; color: #FFF; border-radius: 3px 0 0 3px; padding: 5px 10px;',
         'background: #41b883; border-radius: 0 3px 3px 0;color: #13212E; padding: 5px 10px;font-size: 12px;'
         )
  </script>
EOT;
        $message_append = '';
        if ($count === 1) {
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
            console.log('allow pasting') 
            console.group('php.http.request')
            console.table(log_con)
            console.groupEnd('php.http.request')
 </script>
EOT;
            echo $message_append;
        }
        echo $message;

    }

}



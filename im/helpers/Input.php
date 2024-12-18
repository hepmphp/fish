<?php
/**
 *  fiename: fish/Input.php$
 *  date: 2024/10/17 22:58:05$
 *  author: hepm<ok_fish@qq.com>$
 */
namespace im\helpers;
use im\helpers\Debuger;

class Input {
    public static function trim(&$data){
        $data = array_map('trim',$data);
    }

    public static function xss_clean(&$data, array $preserve_key = array()) {
        if (!is_array($data) || empty($data)) {
            return;
        }
        array_walk($data,
            function(&$value, $key) use($preserve_key) {
                if (is_array($value)) {
                    return self::xss_clean($value, $preserve_key);
                } else {
                    if (in_array($key, $preserve_key) === false) {
                        $value = htmlspecialchars($value, ENT_COMPAT ,'GB2312');
                    }
                }
            });
    }

    /**
     * get请求
     * @param $index
     * @param $xss_clearn
     */
    public static function get($index,$default='',$filter=''){
        $data = isset($_GET[$index])?$_GET[$index]:'';
        if(empty($data) && $default){
            $data = $default;
        }
        if($filter){
            $data = Input::filter($data,$filter);
        }
        return $data;
    }

    /**
     * post请求
     * @param $index
     * @param $xss_clearn
     */
    public static function post($index,$default='',$filter=''){
        $data = isset($_POST[$index])?$_POST[$index]:'';
        if(empty($data) && $default){
            $data = $default;
        }
        if($filter){
            $data = Input::filter($data,$filter);
        }
        return $data;
    }

    public static function get_post($index='',$default='',$filter=''){
        $input = array_merge($_GET,$_POST);
        $data = isset($input[$index])?$input[$index]:'';
        if(empty($data) && $default){
            $data = $default;
        }
        if($filter){
            $data = Input::filter($data,$filter);
        }
        return $data;
    }

    /***
     * php://input获取
     * @param string $index
     * @param string $default
     * @param string $filter
     * @return array|mixed|null|string
     */
    public static function input($index='',$default='',$filter=''){
        parse_str(file_get_contents('php://input'), $input);
        $data = isset($input[$index])?$input[$index]:'';
        if(empty($data) && $default){
            $data = $default;
        }
        if($filter){
            $data = Input::filter($data,$filter);
        }
        return $data;
    }

    /**
     * 过滤
     * @param $data
     * @param string $filter
     * @return array|mixed|null
     */
    public static function filter($data,$filter=''){
        //  $data       =	$input[$name];
        $filters    =   !empty($filter)?$filter:'htmlspecialchars';
        if($filters) {
            $filters    =   explode(',',$filters);
            foreach($filters as $filter){
                if(function_exists($filter)) {
                    $data   =   is_array($data)?array_map($filter,$data):$filter($data); // 参数过滤
                }else{
                    $data   =   filter_var($data,is_int($filter)?$filter:filter_id($filter));
                    if(false === $data) {
                        return	 isset($default)?$default:NULL;
                    }
                }
            }
        }
        return $data;
    }
    /**
     * 获取客户端IP地址
     * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @return mixed
     */
    static function get_client_ip($type = 0) {
        $type       =  $type ? 1 : 0;
        static $ip  =   NULL;
        if ($ip !== NULL) return $ip[$type];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }

    static function is_post(){
        return strtolower($_SERVER['REQUEST_METHOD']) =='post';
    }
    static function is_ajax()
    {
         if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ucwords($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHttpRequest'){
             return true;
         } else{
             return false;
         }
    }

    static function ajax_return($code,$msg,$data=[]){
            $json_data = [
                'code'=>$code,
                'msg'=>$msg,
                'data'=>$data,
                'request_data'=>Input::get_request()
            ];
            echo( json_encode($json_data,JSON_UNESCAPED_UNICODE));

    }

    static function get_request(){
        $headers = [];
        // 获取请求头信息
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) == 'HTTP_') {
                $headerKey = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
                $headers[$headerKey] = $value;
            }
        }
        // 获取GET参数

        // 获取POST参数

        $data['headers'] = $headers;
        $data['get_params'] = $_GET;
        $data['post_params'] = $_POST;
        return $data;
    }

    static function ajax_debug(){

        $console_log       = file_get_contents(WEB_PATH . '/log/console_log.log');
        $console_log_table = file_get_contents(WEB_PATH . '/log/console_log_table.log');
        $data['debug']=[
            'console_log'=>$console_log,
            'console_log_table'=>$console_log_table
        ];
        $json_data = [
            'status'=>0,
            'msg'=>'调试日志',
            'data'=>$data,
        ];
        echo( json_encode($json_data,JSON_UNESCAPED_UNICODE));
    }


    static function is_mobile() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $mobileAgents = array(
            "android",
            "blackberry",
            "iphone",
            "ipad",
            "ipod",
            "iemobile",
            "windows ce",
            "windows phone"
        );
        $mobile = false;
        foreach ($mobileAgents as $agent) {
            if (strripos($userAgent, strtolower($agent)) !== false) {
                $mobile = true;
                break;
            }
        }
        return $mobile;
    }

}

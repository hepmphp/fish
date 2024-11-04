<?php
/**
 *  fiename: fish/Validate.php$🐘
 *  date: 2024/10/18 15:13:04$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\helpers;
/**
 * Class Validate  验证静态类
 */
class Validate
{
    /*防止函数输入错误*/
    const BASE64 = 'base64';
    const CHECKIDCARD = 'check_id_card';
    const CHINESE = 'chinese';
    const DECIMAL = 'decimal';
    const DATE = 'date';
    const EMAIL = 'email';
    const LENGTH = 'length';
    const GENDER = 'gender';
    const GREATETHAN = 'greater_than';
    const IDCARD = 'id_card';
    const INARRAY = 'in_array';
    const INRANGE = 'in_range';
    const INTEGER = 'interger';
    const IP = 'ip';
    const LESSTHAN = 'less_than';
    const MAXLENGTH = 'max_length';
    const MINLENGTH = 'min_length';
    const MOBILE = 'mobile';
    const NUMERIC = 'numeric';
    const POSTALCODE = 'postal_code';
    const PRODUCTNO = 'product_no';
    const QQ = 'qq';
    const REQUIRED = 'required';
    const TELEPHONE = 'telephone';
    const TIME = 'time';
    const URL = 'url';

    public function get_default_status($callback)
    {
        $default_status = [
            Validate::BASE64 => -1,
            Validate::CHECKIDCARD => -2,
            Validate::CHINESE => -3,
            Validate::DECIMAL => -4,
            Validate::EMAIL => -5,
            Validate::LENGTH => -6,
            Validate::GENDER => -7,
            Validate::GREATETHAN => -8,
            Validate::INARRAY => -9,
            Validate::INRANGE => -10,
            Validate::INTEGER => -11,
            Validate::IP => -12,
            Validate::MAXLENGTH => -13,
            Validate::MINLENGTH => -14,
            Validate::MOBILE => -15,
            Validate::NUMERIC => -16,
            Validate::QQ => -17,
            Validate::REQUIRED => -18,
            Validate::DATE => -19,
            Validate::TIME => -20,
            Validate::URL => -21
        ];
        $error_status = $default_status[$callback] ? $default_status[$callback] : -1;
        return $error_status;
    }

    public function get_default_msg($callback, $data='')
    {
        $default_msg = [
            Validate::BASE64 => '输入的base64错误',
            Validate::CHECKIDCARD => '输入的身份证号码错误',
            Validate::CHINESE => '输入的必须是中文',
            Validate::DECIMAL => '输入的必须是小数',
            Validate::EMAIL => '输入的邮箱格式错误',
            Validate::LENGTH => "输入的长度不等于%s",
            Validate::GENDER => '输入的性别错误',
            Validate::GREATETHAN => '输入的数字必须大于%s',
            Validate::INARRAY => '输入的值必须在范围内%s',
            Validate::INRANGE => '输入的值必须在%s之间',
            Validate::INTEGER => '输入的值必须是整形',
            Validate::IP => '输入的ip错误',
            Validate::MAXLENGTH => '输入的最长不能超过%s',
            Validate::MINLENGTH => '输入的最小不能小于2个字符',
            Validate::MOBILE => '输入的手机号码错误',
            Validate::NUMERIC => '输入的必须是数值型',
            Validate::QQ => '输入的qq错误',
            Validate::REQUIRED => '输入的字段不能为空',
            Validate::DATE => '输入的日期格式错误',
            Validate::TIME => '输入的时间格式错误',
            Validate::URL => '输入的url格式错误'
        ];
        $error_msg = $default_msg[$callback] ? $default_msg[$callback] : '';
//        if (!empty($data)) {
//            if(is_array($data)){
//                $error_msg = sprintf($error_msg, implode(',', $data));
//            }else{
//                $error_msg = sprintf($error_msg, $data);
//            }
//        }
        return $error_msg;
    }

    public $param = array();
    public $rules = array();
    public $error_list = array();

    public function __construct($param = '', $rules = '')
    {
        $this->param = $param;
        $this->rules = $rules;
    }

    public function set_param($param, $rules)
    {
        $this->param = $param;
        $this->rules = $rules;

    }

    public function validate_rules()
    {
        $class_methods = get_class_methods($this);

        foreach ($this->param as $key => $value) {
            if (!in_array($this->rules[$key][0], $class_methods)) {
                foreach ($this->rules[$key] as $rule) {
                    $call_back = $rule[0];//验证的回调函数
                    $data = $rule[3];//参数
                    $error_msg = $rule[1] ? $rule[1] : $this->get_default_msg($call_back, $data);//错误消息
                    $status = $rule[2] ? $rule[2] : $this->get_default_status($call_back, $data);//错误代码

                    $this->validate_callback($call_back, $value, $error_msg, $status, $data);
                }
            } else {

                $call_back = $this->rules[$key][0];//验证的回调函数
                $data = isset($this->rules[$key][3])?$this->rules[$key][3]:'';//参数
                $error_msg = $this->rules[$key][1] ? $this->rules[$key][1] : $this->get_default_msg($call_back, $data);//错误消息
                $status = $this->rules[$key][2] ? $this->rules[$key][2] : $this->get_default_status($call_back, $data);//错误代码
                $this->validate_callback($call_back, $value, $error_msg, $status, $data);
            }
        }
        if (empty($this->error_list)) {
            return true;
        } else {
            return false;
        }
    }

    public function validate_callback($call_back, $value, $error_msg, $status, $data)
    {
        if (!call_user_func_array(array(__NAMESPACE__ . '\Validate', $call_back), array($value, $data,$error_msg,$status))) {
            $this->set_error($error_msg, $status);
        }
    }

    public function set_error($msg, $status = -1)
    {
        array_unshift($this->error_list, array('status' => $status, 'msg' => $msg));
    }

    public function get_error($first = true)
    {
        return $first ? array_pop($this->error_list) : $this->error_list;
    }


    static function check_id_card($idcard)
    {
        // 只能是18位
        if (strlen($idcard) != 18) {
            return false;
        }
        // 取出本体码
        $idcard_base = substr($idcard, 0, 17);

        // 取出校验码
        $verify_code = substr($idcard, 17, 1);

        // 加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        // 校验码对应值
        $verify_code_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
        // 根据前17位计算校验码
        $total = 0;
        for ($i = 0; $i < 17; $i++) {
            $total += substr($idcard_base, $i, 1) * $factor[$i];
        }
        // 取模
        $mod = $total % 11;
        // 比较校验码
        if ($verify_code == $verify_code_list[$mod]) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *  检查日期 xxxx-xx-xx
     */
    public static function date($date = '')
    {
        return preg_match('/^[\d]{4}\-[\d]{1,2}-[\d]{1,2}$/', $date);
    }

    /**
     *  检查完整日期 xxxx-xx-xx xx:xx:xx
     */
    public static function time($date = '')
    {
        return preg_match('/^[\d]{4}\-[\d]{1,2}-[\d]{1,2} [\d]{1,2}:[\d]{1,2}:[\d]{1,2}$/', $date);
    }

    /**
     *  检查手机号码
     */
    public static function mobile($mobile = '')
    {
        return preg_match("/^1[3|4|5|7|8][0-9]\d{8}$/", $mobile);
    }

    /**
     *  检查email格式
     */
    public static function email($email = '')
    {
        return preg_match("/^[\w\-\.]+@[\w\-]+(\.\w+)+$/", $email);
    }

    /**
     *  检查邮政编码
     */
    public static function postal_code($postal_code = '')
    {
        return preg_match("/[1-9]{1}(\d+){5}/", $postal_code);
    }

    /**
     *  检查ipv4 地址
     */
    public static function ip($ip)
    {
        return preg_match("/(\d+){1,3}\.(\d+){1,3}\.(\d+){1,3}\.(\d+){1,3}/", $ip);
    }

    /**
     *  检查qq号码
     */
    public static function qq($qq = '')
    {
        return preg_match("/^[1-9](\d){4,11}$/", $qq);
    }

    /**
     *  检查身份证号码
     */
    public static function id_card($id_card = '')
    {
        return (preg_match("/^\d{17}(\d|x)$/i", $id_card) || preg_match("/^\d{15}$/i", $id_card));
    }

    /**
     *  检查性别
     */
    public static function gender($gender)
    {
        return in_array($gender, array(0, 1));
    }

    /**
     *  检查产品编号
     */
    public static function product_no($product_no = '')
    {
        return preg_match('/^[0-9a-zA-Z-]{1,16}$/', $product_no);
    }

    /**
     *  检查电话号码
     */
    public static function telephone($telephone = '')
    {
        return preg_match("/^[\d]+[\d-]*[\d]$/", $telephone);
    }

    /**
     *  url地址(简单检查是否以http://开头)
     */
    public static function url($url = '')
    {
        return preg_match('/^http[s]?:\/\/.*?/i', $url);
    }

    /**
     *  检查是否全中文
     *  ------------------------------
     * 中文双字节字符编码范围
     * 1. GBK (GB2312/GB18030)
     * x00-xff GBK双字节编码范围
     * x20-x7f ASCII
     * xa1-xff 中文 gb2312
     * x80-xff 中文 gbk
     * 2. UTF-8 (Unicode)
     * u4e00-u9fa5 (中文)
     * x3130-x318F (韩文
     * xAC00-xD7A3 (韩文)
     * u0800-u4e00 (日文)
     */
    public static function chinese($str)
    {
        //return preg_match('/^[\xa1-\xff]+$/', $str);
        return preg_match('/^[\x80-\xff]+$/', $str);
    }

    public static function required($str)
    {
        if (!is_array($str)) {
            return (trim($str) == '') ? FALSE : TRUE;
        } else {
            return (!empty($str));
        }
    }

    public static function min_length($str, $val)
    {
        if (preg_match("/[^0-9]/", $val)) {
            return FALSE;
        }
        if (function_exists('mb_strlen')) {
            return (mb_strlen($str) < $val) ? FALSE : TRUE;
        }
        return (strlen($str) < $val) ? FALSE : TRUE;
    }

    public static function max_length($str, $val)
    {
        if (preg_match("/[^0-9]/", $val)) {
            return FALSE;
        }
        if (function_exists('mb_strlen')) {
            return (mb_strlen($str) > $val) ? FALSE : TRUE;
        }
        return (strlen($str) > $val) ? FALSE : TRUE;
    }

    public static function length($str, $val)
    {
        if (preg_match("/[^0-9]/", $val)) {
            return FALSE;
        }
        if (function_exists('mb_strlen')) {
            return (mb_strlen($str) != $val) ? FALSE : TRUE;
        }
        return (strlen($str) != $val) ? FALSE : TRUE;
    }

    public static function numeric($str)
    {
        return (bool)preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $str);
    }

    public static function is_numeric($str)
    {
        return (!is_numeric($str)) ? FALSE : TRUE;
    }

    public static function integer($str)
    {
        return (bool)preg_match('/^[\-+]?[0-9]+$/', $str);
    }

    public static function decimal($str)
    {
        return (bool)preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $str);
    }

    public static function greater_than($str, $min)
    {
        if (!is_numeric($str)) {
            return FALSE;
        }
        return $str > $min;
    }

    public static function less_than($str, $max)
    {
        if (!is_numeric($str)) {
            return FALSE;
        }
        return $str < $max;
    }

    public static function in_range()
    {
        $args = func_get_args();
        $num = $args[0];
        $min = $args[1][0];
        $max = $args[1][1];
        return self::less_than($num, $max) && self::greater_than($num, $min);
    }

    public static function base64($str)
    {
        return (bool)!preg_match('/[^a-zA-Z0-9\/\+=]/', $str);
    }

    public static function in_array($search, $dataArr)
    {
        return in_array($search, $dataArr);
    }
}
/**
 *
 * if(!Validate::date($data['id'])){
 * print_r(Msg::status_msg(ErrorCode::DB,Validate::get_error(Validate::DATE)));
 * }
 *
 * $data = array(
 * 'base'=>1,
 * 'check_id_card'=>'35052119900',
 * 'chinese'=>'124',
 * 'decimal'=>'12',
 * 'email'=>'hepm',
 * 'length'=>123,
 * 'gender'=>3,
 * 'gt'=>120,
 * 'inarr'=>2,
 * 'ir'=>1,
 * 'int'=>'1',
 * 'ip'=>'127.0.01',
 * 'ml'=>'11111111111111111111111111111111111111111111111',
 * 'minl'=>'1',
 * 'mobile'=>'15210',
 * 'numeric'=>'12a',
 * 'qq'=>'123',
 * 'required'=>'1',
 * 'date'=>'aaa',
 * 'time'=>'aaa',
 * 'url'=>'url',
 * );
 * $validate_rules = [
 * '字段名'=>['验证器','验证提示信息','错误代码','额外参数']
 * 'base'         =>[Validate::BASE64,'base64错误',-1],
 * 'check_id_card'=>[Validate::CHECKIDCARD,'身份证号码错误',-2],
 * 'chinese'      =>[Validate::CHINESE,'姓名输入的必须是中文',-3],
 * 'decimal'      =>[Validate::DECIMAL,'必须是小数',-4],
 * 'email'        =>[Validate::EMAIL,'邮箱格式错误',-5],
 * 'length'       =>[Validate::LENGHT,'长度不能超过10',-6,10],
 * 'gender'       =>[Validate::GENDER,'性别错误',-7],
 * 'gt'           =>[Validate::GREATETHAN,'数字必须大于100',-8,100],
 * 'inarr'        =>[Validate::INARRAY,'值必须在范围内2,3,4,5',-9,[2,3,4,5]],
 * 'ir'           =>[Validate::INRANGE,'值必须在90,100之间',-10,[90,10]],
 * 'int'          =>[Validate::INTEGER,'值必须是整形',-11],
 * 'ip'           =>[Validate::IP,'ip错误',-12],
 * 'ml'           =>[Validate::MAXLENGTH,'最长不能超过15',-13,15],
 * 'minl'         =>[Validate::MINLENGTH,'最小不能小于2个字符',-14,2],
 * 'mobile'       =>[Validate::MOBILE,'手机号码错误',-15],
 * 'numeric'      =>[Validate::NUMERIC,'必须是数值型',-16],
 * 'qq'           =>[Validate::QQ,'qq错误',-17],
 * 'required'     =>[Validate::REQUIRED,'字段不能为空',-18],
 * 'date'         =>[Validate::DATE,'日期格式错误',-19],
 * 'time'         =>[Validate::TIME,'时间格式错误',-20],
 * 'url'          =>[Validate::URL,'url格式错误',-21],
 * ];
 * $validate = new Validate();
 * $validate->set_param($data,$validate_rules);
 * if(!$validate->validate()){
 * echo "<pre>";
 * print_r($validate->get_error(false));
 * }
 */

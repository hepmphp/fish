<?php
namespace app\helpers;
class VerifyCode{
    public function check($code)
    {
        // 验证码不能为空
        $secode = isset($_SESSION['verify_code']) ? $_SESSION['verify_code'] : '';
        if (empty($code) || empty($secode)) {
            return false;
        }
        // session 过期
        if (time() - $_SESSION['verify_time'] > 60) {
            unset($_SESSION['verify_code']);
            unset($_SESSION['verify_time']);
            return false;
        }
        if (strtoupper($code) == $_SESSION['verify_code']) {
            unset($_SESSION['verify_code']);
            unset($_SESSION['verify_time']);
            return true;
        }
        return false;
    }
    public function image(){
        // 生成随机数和运算符
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        $operators = ['+', '-','*'];
        $operator = $operators[array_rand($operators)];
        // 计算结果
        if($operator=='+'){
            $captcha_result = $num1+$num2;
        }elseif($operator=='-'){
            $captcha_result = $num1-$num2;
        }elseif ($operator=='*'){
            $captcha_result = $num1*$num2;
        }
        // 生成验证码字符串
        $captcha_text = "$num1 $operator $num2 = ?";
        // 存储验证码结果
        $_SESSION['verify_code'] = $captcha_result;
        $_SESSION['verify_time'] = time();
        // 设置验证码图片的宽高
        $width = 100;
        $height = 40;
        // 创建一个图片资源
        $image = imagecreatetruecolor($width, $height);
        // 分配颜色
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        $gray = imagecolorallocate($image, 200, 200, 200);
        // 填充背景色
        imagefilledrectangle($image, 0, 0, $width, $height, $white);
        // 添加一些干扰像素
        for ($i = 0; $i < 100; $i++) {
            imagesetpixel($image, rand(0, $width), rand(0, $height), $gray);
        }
        // 添加文本
       // var_dump( WEB_PATH . '/static/admin/fonts/');
        $font_size = 14;
        $font = WEB_PATH . '/static/admin/fonts/arial.ttf'; // 确保你有这个字体文件，或者使用其他路径
        imagettftext($image, $font_size, 0, 10, 30, $black, $font, $captcha_text);
        // 输出图片
        header('Content-type: image/png');
        imagepng($image);
        // 销毁图片资源
        imagedestroy($image);
    }
}

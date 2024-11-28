<?php
/**
 *  fiename: fish/Ding.php$🐘
 *  date:  2024/11/28   15:18$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */

namespace app\helpers;

class Ding{

    public function login_return($form){
        $access_key = 'dingddkkgubjhda94txs'; //应用的AppKey
        $app_secret = 'd-T-FhpekLwbsdqMel2NtLWVmkceebNo16Nx8ao8m2oZWB4T_qIQAAHnO-FZfCDR'; //应用秘钥
        $code = json_encode(['tmp_auth_code' => $form['code']]); //获取临时code
        $time = time() . '000'; //毫秒时间戳
        $urlencode_signature = $this->getSignature($time, $app_secret); //签名
        //地址组装,获取用户信息
        $remote_server = 'https://oapi.dingtalk.com/sns/getuserinfo_bycode?accessKey='. $access_key .'&timestamp=' . $time . '&signature=' . $urlencode_signature;
        $json = $this->PostCurlRequest($remote_server, $code);
        return json_decode($json,true);
    }

    function getSignature($timestamp, $appSecret){
        // 根据timestamp, appSecret计算签名值
        $s = hash_hmac('sha256', $timestamp, $appSecret, true);
        $signature = base64_encode($s);
        $urlencode_signature = urlencode($signature);
        return $urlencode_signature;
    }

    /**
     * post 请求
     * @param $remote_server
     * @param $post_string
     * @return bool|string
     */
    function PostCurlRequest($remote_server, $code)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remote_server);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $code);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
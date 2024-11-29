<?php
/**
 *  fiename: fish/WeinLogin.php$🐘
 *  date:  2024/11/28   13:31$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\helpers;

class WeixinLogin
{

    /**
     * 微信开放平台appid
     * @var string
     */
    protected static $kF_AppId = 'wxabd4205731293882';

    /**
     * 微信开放平台app secret
     * @var string
     */
    protected static $KF_AppSecret = '6f9961c4911c877689a33559887b709e';


    /**
     * 通过开放平台key获取微信登录页面
     * 可通过回调获取code参数
     * @param $callback_url:回调地址
     * @return string
     */
    public function getKFLoginUrl($callback_url)
    {
        $callback = urlencode($callback_url);
        $AppId = self::$kF_AppId;
        $get_code_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$AppId}&redirect_uri={$callback}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        return $get_code_url;
    }

    /**
     * 通过开放平台key
     * 获取用户openId access_token
     * @param $code
     * @return bool|string
     */
    public function getKFOpenId($code)
    {
        $AppId = self::$kF_AppId;
        $AppSecret = self::$KF_AppSecret;
        $get_openid_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$AppId}&secret={$AppSecret}&code={$code}&grant_type=authorization_code";
        $res = file_get_contents($get_openid_url);
        $res = json_decode($res, true);
        return $res;
    }

    /**
     * 获取微信用户信息
     * @param $access_token
     * @param $openId
     * @return bool|mixed
     */
    public function getUserInfo($access_token, $openId)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openId}&lang=zh_CN";
        $res = $this->linkCurl($url, 'GET');
        $res = json_decode($res, true);
        return $res;
    }

    /**
     * 请求接口返回内容
     * @param $url :请求的URL地址
     * @param $method :请求方式POST|GET
     * @param $params :请求的参数
     * @param $header : 请求头
     * @return bool|string
     */
    protected function linkCurl($url, $method, $params = array(), $header = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (strpos("$" . $url, "https://") == 1) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if ($method == "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        } else if ($params) {
            curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
        }
        $response = curl_exec($ch);
        if ($response === false) {
            return false;
        }
        curl_close($ch);
        return $response;
    }
}

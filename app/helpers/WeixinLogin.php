<?php
/**
 *  fiename: fish/WeinLogin.php$🐘
 *  date:  2024/11/28   13:31$🐘
 *  author: hepm<ok_fish@qq.com>$🐘
 */
namespace app\helpers;
//session_start();
//if ($_SESSION['openid']) {
//    exit('已经授权登录过了。。。');
//
//}
//{
//    $wx_login = new Wxlogin();
//    $userinfo = $wx_login->getUserInfo();
//    if ($userinfo['openid']) {
//
//        $_SESSION['openid'] = $userinfo['openid'];
//
//        var_dump($userinfo);
//
//    } else {
//        exit('授权失败');
//    }
//}


/*
*
开发平台 授权回调域  www.xxx.com
*/


class WeixinLogin
{

    private $login_page_url = "https://open.weixin.qq.com/connect/qrconnect?";//微信登录界面
    private $get_accessToken_url = "https://api.weixin.qq.com/sns/oauth2/access_token?";//后去token的url
    //private $get_openId_url = 'https://graph.qq.com/oauth2.0/me';//获取openid的url
    private $get_user_info = "https://api.weixin.qq.com/sns/userinfo?";//获取用户信息的url
    private $app_id = 'wxabd4205731293882';
    private $app_key = '6f9961c4911c877689a33559887b709e';
    public $redirect_url = 'http://www.dianjiuwan.com/weixinpc.php';
    private $access_token;

    //微信登录页面
    private function get_wx_login_page()
    {
        $state = md5(rand(1, 1000));
        $query = [
            'appid' => $this->app_id,
            'redirect_uri' => $this->redirect_url,
            'response_type' => 'code',
            'scope' => 'snsapi_login',
            'state' => $state,
        ];
        $_SESSION['state'] = $state;//保存state验证

        $url = $this->login_page_url . http_build_query($query) . '#wechat_redirect';
        header("Location:$url");
        exit;
    }

    //获取access_token
    private function get_code()
    {
        //获取code
        @$code = $_GET['code'];
        if (!$code) {
            $this->get_wx_login_page();
        }
        $state = $_GET['state'];
        /*
        if($state != $_SESSION['state']){
            echo "state is wrong!";
            exit;
        }
        */
        $_SESSION['state'] = null;
        $query = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'secret' => $this->app_key,
            'appid' => $this->app_id,
        ];

        return $this->get_curl($this->get_accessToken_url, http_build_query($query));

    }

    //获取token
    private function get_token_info()
    {
        //获取access_token
        /* {
            "access_token":"ACCESS_TOKEN",
            "expires_in":7200,
            "refresh_token":"REFRESH_TOKEN",
            "openid":"OPENID",
            "scope":"SCOPE"
        } */
        $data = json_decode($this->get_code(), true);
        //参数组装数组
        $this->access_token = $data["access_token"];

        $array = array(
            'access_token' => $data["access_token"],
            'openid' => $data['openid'],
        );

        return $this->get_curl($this->get_user_info, http_build_query($array));
    }

    //获取openid&&获取用户信息
    public function getUserInfo()
    {
        $data = $this->get_token_info();
        $data = json_decode($data, true);
        $data['access_token'] = $this->access_token;
        return $data;
    }

    //curl GET请求
    private function get_curl($url, $query)
    {
        $url_request = $url . $query;
        $curl = curl_init();

        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url_request);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回,而不是直接输出.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        return $data;

    }
}


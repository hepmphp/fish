<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理后台支付宝扫码</title>
</head>
<body>
<div class="text-center" style="margin: 0 auto;">
    <h1 class="display-4" style="text-align: center;">管理后台支付宝扫码绑定</h1>
    <div id="login_container"></div>
</div>


</body>
<script src="https://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script>
<script>
    var obj = new WxLogin({
        self_redirect: false,    //默认为false(保留当前二维码)  true(当前二维码所在的地方通过iframe 内跳转到 redirect_uri)
        id: "login_container",  //容器的id
        appid: "wxabd4205731293882",  //应用唯一标识，在微信开放平台提交应用审核通过后获得
        scope: "snsapi_login",   //应用授权作用域，拥有多个作用域用逗号（,）分隔，网页应用目前仅填写snsapi_login即可
        redirect_uri: "http://mail.okfish.asia/user/login_weixin_return",    //扫完码授权成功跳转到的路径
        // state: "",    //用于保持请求和回调的状态，授权请求后原样带回给第三方。该参数可用于防止 csrf 攻击（跨站请求伪造攻击），建议第三方带上该参数，可设置为简单的随机数加 session 进行校验
        style: "white",   //提供"black"、"white"可选，默认为黑色文字描述
        href: "data:text/css;base64,LmxvZ2luUGFuZWwubm9ybWFsUGFuZWwgLnRpdGxlIHsNCiAgZGlzcGxheTogbm9uZTsNCn0NCi5xcmNvZGUubGlnaHRCb3JkZXIgew0KICB3aWR0aDogMTc0cHg7DQogIGhlaWdodDogMTc0cHg7DQogIG1hcmdpbi10b3A6IDA7DQogIGJveC1zaXppbmc6IGJvcmRlci1ib3g7DQp9DQouaW1wb3dlckJveCAuaW5mbyB7DQogIGRpc3BsYXk6IG5vbmU7DQp9DQoud2ViX3FyY29kZV90eXBlX2lmcmFtZSB7DQogIHdpZHRoOiAxNzRweDsNCn0NCg=="  //自定义样式链接，第三方可根据实际需求覆盖默认样式
    })

</script>
</html>

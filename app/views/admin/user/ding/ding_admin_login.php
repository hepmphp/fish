<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>钉钉扫码登录测试</title>
</head>
<body>
<div class="text-center">
    <h1 class="display-4" style="text-align: center;">管理后台钉钉扫码绑定</h1>
    <div id="login_container" style="text-align: center;"></div>
</div>
<script src="https://g.alicdn.com/dingding/dinglogin/0.0.5/ddLogin.js"></script>
<script type="text/javascript">
    var url = encodeURIComponent("http://mail.okfish.asia/admin/user/ding_login_admin_return?exert=test");
    var obj = DDLogin({
        id: "login_container",
        goto: encodeURIComponent('https://oapi.dingtalk.com/connect/oauth2/sns_authorize?appid=dingddkkgubjhda94txs&response_type=code&scope=snsapi_login&state=STATE&redirect_uri=' + url),
        style: "border:none;background-color:#FFFFFF;",
        width: "365",
        height: "400",
    });
    var handleMessage = function (event) {
        var origin = event.origin;
        console.log("loginTmpCode", event.data);
        console.log(origin);
        console.log("origin", event.origin);
        if (origin == "https://login.dingtalk.com") { //判断是否来自ddLogin扫码事件。
            var loginTmpCode = event.data; //拿到loginTmpCode后就可以在这里构造跳转链接进行跳转了
            console.log("loginTmpCode", loginTmpCode);
            window.location.href =
                "https://oapi.dingtalk.com/connect/oauth2/sns_authorize?appid=**********&response_type=code&scope=snsapi_login&state=STATE&redirect_uri=" + url + "&loginTmpCode=" +
                loginTmpCode;
        }
    };
    if (typeof window.addEventListener != 'undefined') {
        window.addEventListener('message', handleMessage, false);
    } else if (typeof window.attachEvent != 'undefined') {
        window.attachEvent('onmessage', handleMessage);
    }
</script>
</body>
</html>

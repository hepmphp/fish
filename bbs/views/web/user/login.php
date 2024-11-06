<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户登录</title>
    <link href="<?=STATIC_URL?>css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>css/commom.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>css/login.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?=STATIC_URL?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=STATIC_URL?>js/layer/layer.js"></script>

</head>
<body>

<div id="wrapper">
    <div class="aw-login-box">
        <div class="mod-body clearfix">
            <div class="content pull-left">
                <h1>用户登录</h1>
                <form id="login_form" method="post" onsubmit="return false">
                    <ul>
                        <li>
                            <input type="text" id="username" class="form-control" placeholder="邮箱 / 用户名" name="username">
                        </li>
                        <li>
                            <input type="password" id="password" class="form-control" placeholder="密码" name="password">
                        </li>
                        <li class="alert alert-danger collapse error_message">
                            <i class="icon icon-delete"></i> <em></em>
                        </li>
                        <li class="last">
                            <a href="javascript:;" id="login_submit" class="pull-right btn btn-large btn-primary">登录</a>
                            <label>
                                <input type="checkbox" value="1" name="net_auto_login">
                                记住我							</label>
                            <a href="/bbs.php/web/user/find_password/">&nbsp;&nbsp;忘记密码</a>
                        </li>
                    </ul>
                </form>
            </div>

        </div>
        <div class="mod-footer">
            <span>还没有账号?</span>&nbsp;&nbsp;
            <a href="/bbs.php/web/user/register">立即注册</a>&nbsp;&nbsp;•&nbsp;&nbsp;
        </div>
    </div>
</div>
</body>
<script>
    $("#login_submit").click(function () {
        var username = $('#username').val();
        var password = $('#password').val();

        if (username == '') {
            layer.msg('请填写用户名', {icon: 2});
            return false;
        }
        if (password == '') {
            layer.alert('请填写密码', {icon: 2});
            return false;
        }

        var param = {
            username: username,
            password: password,
        };
        console.log(param);
        $.ajax({
            type: 'POST',
            url: '/bbs.php/web/user/login',
            data: param,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.status == 0) {
                    layer.alert(data.msg, {icon: 1}, function () {
                        window.location.href = '/bbs.php';
                    });
                } else {
                    layer.alert(data.msg, {icon: 2}, function () {

                    });
                }
            }
        });
    });
</script>
</html>
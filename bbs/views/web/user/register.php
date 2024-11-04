<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="<?=STATIC_URL?>css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>css/commom.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>css/register.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="aw-register-box">
    <div class="mod-head">
        <a href=""><img src="http://127.0.0.1:1111/wecenter/static/css/default/img/login_logo.png" alt=""></a>
        <h1>注册新用户</h1>
    </div>
    <div class="mod-body">
        <form class="aw-register-form" action="http://127.0.0.1:1111/wecenter/?/account/ajax/register_process/" method="post" id="register_form">

            <ul>
                <li class="alert alert-danger collapse error_message text-left">
                    <i class="icon icon-delete"></i> <em></em>
                </li>
                <li>
                    <input class="aw-register-name form-control" type="text" name="user_name" placeholder="用户名" tips="请输入一个 2-14 位的用户名" errortips="用户名长度不符合" value="">
                </li>
                <li>
                    <input class="aw-register-email form-control" type="text" placeholder="邮箱" name="email" tips="请输入你常用的电子邮箱作为你的账号" value="" errortips="邮箱格式不正确">
                </li>
                <li>
                    <input class="aw-register-pwd form-control" type="password" name="password" placeholder="密码" tips="请输入 6-16 个字符,区分大小写" errortips="密码不符合规则">
                </li>


                <li class="aw-register-verify">
                    <img class="pull-right" id="captcha" onclick="this.src = G_BASE_URL + '/account/captcha/' + Math.floor(Math.random() * 10000);" src="http://127.0.0.1:1111/wecenter/?/account/captcha/">

                    <input type="text" class="form-control" name="seccode_verify" placeholder="验证码">
                </li>

                <li class="clearfix">
                    <button class="btn btn-large btn-blue btn-block" onclick="AWS.ajax_post($('#register_form'), AWS.ajax_processer, 'error_message'); return false;">注册</button>
                </li>
            </ul>
        </form>
    </div>
    <div class="mod-footer"></div>
</div>
</body>
</html>
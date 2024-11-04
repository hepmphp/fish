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
        <h1>找回密码</h1>
    </div>
    <div class="mod-body">
        <form class="aw-register-form" id="fpw_form" method="post" action="http://127.0.0.1:1111/wecenter/?/account/ajax/request_find_password/">
            <ul>
                <li class="alert alert-danger collapse error_message">
                    <i class="icon icon-delete"></i><em></em>
                </li>
                <li>
                    <input class="aw-register-email form-control" type="text" placeholder="邮箱" name="email">
                </li>
                <li class="aw-register-verify">
                    <img class="auth-img pull-right" id="captcha" onclick="this.src = G_BASE_URL + '/account/captcha/' + Math.floor(Math.random() * 10000);" src="http://127.0.0.1:1111/wecenter/?/account/captcha/">
                    <input class="form-control" type="text" name="seccode_verify" placeholder="验证码">
                </li>
                <li class="clearfix">
                    <button class="btn btn-large btn-blue btn-block" onclick="AWS.ajax_post($('#fpw_form'), AWS.ajax_processer, 'error_message'); return false;">下一步</button>
                </li>
            </ul>
        </form>
    </div>
</div>
</body>
</html>
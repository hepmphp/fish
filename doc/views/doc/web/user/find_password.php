<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>找回密码</title>
    <link href="<?=STATIC_URL?>css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>css/commom.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>css/register.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?=STATIC_URL?>js/jquery.min.js"></script>
</head>
<body>
<div class="aw-register-box">
    <div class="mod-head">
        <h1>找回密码</h1>
    </div>
    <div class="mod-body">
        <form class="aw-register-form" id="fpw_form" method="post" action="/doc.php/web/user/reset_password">
            <ul>
                <li class="alert alert-danger collapse error_message">
                    <i class="icon icon-delete"></i><em></em>
                </li>
                <li>
                    <input class="aw-register-email form-control" type="text" placeholder="邮箱" name="username" id="username">
                </li>
                <li class="aw-register-verify">
                    <img class="auth-img pull-right" id="captcha"  src="/doc.php/web/captcha/get">
                    <input type="text" class="form-control" name="code" id="code" placeholder="验证码">
                </li>
                <li class="clearfix">
                    <input type="submit" class="btn btn-large btn-blue btn-block" value="下一步">
                </li>
            </ul>
        </form>
    </div>
</div>
</body>
<script>
    $('#captcha').click(function(){
        var captcha_url = '/doc.php/web/captcha/get?'+Date.parse(new Date());
        $('#captcha').attr('src',captcha_url);
    });
</script>
</html>
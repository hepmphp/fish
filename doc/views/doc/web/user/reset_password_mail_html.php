<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>找回密码</title>
    <link href="<?=STATIC_URL?>css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>css/commom.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>css/register.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?=STATIC_URL?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=STATIC_URL?>js/layer/layer.js"></script>
</head>
<body>
<div class="aw-register-box">
    <div class="mod-head">
        <h1>重置密码</h1>
    </div>
    <div class="mod-body">
        <form class="aw-register-form" id="fpw_form" method="post" action="#"  onsubmit="return false;">
            <ul>
                <li class="alert alert-danger collapse error_message">
                    <i class="icon icon-delete"></i><em></em>
                </li>

                <li>用户id
                    <input class="form-control" type="text" placeholder="" name="user_id" id="user_id" value="<?=$form['user_id']?>">
                </li>
                <li style="display: none">
                    <input class="form-control" type="text" placeholder="" name="fish_code" id="fish_code" value="<?=$form['fish_code']?>">
                </li>
                <li>
                    <input class="form-control" type="password" placeholder="" name="password" id="password">
                </li>
                <li class="clearfix">
                    <button class="btn btn-large btn-blue btn-block" id="btn_reset_password_mail" >重置密码</button>
                </li>
            </ul>
        </form>
    </div>
</div>
</body>
<script>

    $("#btn_reset_password_mail").click(function () {
        var user_id = $('#user_id').val();
        var fish_code = $('#fish_code').val();
        var password = $('#password').val();

        if (user_id == '') {
            layer.msg('请输入用户id', {icon: 2});
            return false;
        }
        if (fish_code == '') {
            layer.alert('验证码错误', {icon: 2});
            return false;
        }
        if (password == '') {
            layer.alert('请填写密码', {icon: 2});
            return false;
        }
        var param = {
            user_id:user_id,
            fish_code: fish_code,
            password: password,
        };
        console.log(param);
        $.ajax({
            type: 'POST',
            url: '/doc.php/web/user/reset_password_mail',
            data: param,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.status == 0) {
                    layer.alert(data.msg, {icon: 1}, function () {
                        window.location.href = '/doc.php';
                    });
                } else {
                    layer.alert(data.msg, {icon: 2}, function () {
                        layer.closeAll();
                    });
                }
            }
        });
    });
</script>
</html>
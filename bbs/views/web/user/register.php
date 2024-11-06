<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="<?=STATIC_URL?>css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>css/commom.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>css/register.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>js/image-select/ImageSelect.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?=STATIC_URL?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=STATIC_URL?>js/layer/layer.js"></script>
    <script type="text/javascript" src="<?=STATIC_URL?>js/image-select/chosen.jquery.js"></script>
    <script type="text/javascript" src="<?=STATIC_URL?>js/image-select/ImageSelect.jquery.js"></script>
    <link  href="<?=STATIC_URL?>js/image-select/chosen.css" rel="stylesheet" type="text/css" >
    <link  href="<?=STATIC_URL?>js/image-select/ImageSelect.css" rel="stylesheet" type="text/css" >
</head>
<body>
<div class="aw-register-box">
    <div class="mod-head">
        <h1>注册新用户</h1>
    </div>
    <div class="mod-body">
        <form class="aw-register-form" action="" method="post" id="register_form" onsubmit="return false;">
            <?php foreach ($image_list as $image){?>
            <?=$image?>
            <?php }?>
            <select id="avator" name="avator" class="my-select">
                <?php foreach ($options as $option){?>
                    <?=$option?>
                <?php }?>
            </select>
            <ul>
                <li>

                </li>
                <li>
                    <input class="aw-register-name form-control" type="text" name="username" id="username" placeholder="用户名"  value="">
                </li>
                <li>
                    <input class="aw-register-email form-control" type="text" placeholder="邮箱" id="email" name="email" >
                </li>
                <li>
                    <input class="aw-register-pwd form-control" type="password" name="password" id="password" placeholder="密码" >
                </li>

                <li class="aw-register-verify">
                    <img class="pull-right" id="captcha" src="/bbs.php/web/captcha/get">

                    <input type="text" class="form-control" name="code" id="code" placeholder="验证码">
                </li>

                <li class="clearfix">
                    <button class="btn btn-large btn-blue btn-block" id="register" >注册</button>
                </li>
            </ul>
        </form>
    </div>
    <div class="mod-footer"></div>
</div>
<script>
    $('#avator').change(function () {
        var that = $(this).val();
        $('.image').filter("[value='"+that+"']").show().siblings('.image').hide();
        // console.log(that);
        // $.each($('.image'), function (i, v) {
        //     $(this).eq($(this).val()).show().siblings('.image').hide();
        // });
    });

    $('#captcha').click(function(){
        var captcha_url = '/bbs.php/web/captcha/get?'+Date.parse(new Date());
        $('#captcha').attr('src',captcha_url);
    });
    $("#register").click(function () {
        var username = $('#username').val();
        var password = $('#password').val();
        var email = $('#email').val();
        var code = $('#code').val();
        var avator = $('#avator').val();
        if (username == '') {
            layer.msg('请填写用户名', {icon: 2});
            return false;
        }
        if (password == '') {
            layer.alert('请填写密码', {icon: 2});
            return false;
        }
        if (code == '') {
            layer.alert('请填写验证码', {icon: 2});
            return false;
        }
        var param = {
            avator:avator,
            username: username,
            password: password,
            email: email,
            code: code,
        };
        console.log(param);
        $.ajax({
            type: 'POST',
            url: '/bbs.php/web/user/create',
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
                        if (data.status != 0) {
                            var captcha_url = '/bbs.php/web/captcha/get?'+Date.parse(new Date());
                            $('#captcha').attr('src', captcha_url);
                            layer.closeAll();
                        }
                    });
                }
            }
        });
    });

</script>
</body>
</html>
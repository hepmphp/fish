<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - 登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="<?=STATIC_URL?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>css/font-awesome.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>css/animate.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>css/style.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>css/screen.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?=STATIC_URL?>js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>js/respond.min.js"></script>
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
    <style>
        .http-option {
            border: 1px solid #ddd;
            border-bottom-left-radius: 3px;
            border-bottom-right-radius: 3px;
            padding: 15px;
            width: 500px;
        }

        .tab-content {
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            border-bottom-left-radius: 3px;
            border-bottom-right-radius: 3px;
            padding: 15px;
        }
    </style>
</head>
<?php
    $i = mt_rand(1,5);

?>
<body style="background: url('http://127.0.0.1/static/admin/images/login_bg/<?=$i?>.gif') no-repeat;background-position:55% -50px; ">

<?php
?>

<div class="middle-box text-center loginscreen  animated fadeInDown" style="z-index: 9999">
    <div class="logo-bg">
<!--        <h1 class="logo-name"><img src="--><?//=STATIC_URL?><!--/images/logo.png" alt="服务器信息管理系统" width="234" height="234">服务器信息管理系统</h1>-->
        <form class="m-t" role="form" id="form">
            <div class="form-group">
                <h1 style="font-weight: bold;font-size: 30px;color: black">管理后台</h1>
            </div>
            <div class="http-option" id="httpOptionBox" style="margin-top: 30px;">
                <ul class="nav nav-tabs ">
                    <li class="active" data-index="0"><a href="###" data-target="#loginFrom" data-toggle="tab" aria-expanded="true">账号登录</a></li>
                    <li data-index="1" class=""><a href="###" data-target="#emaliForm" data-toggle="tab" aria-expanded="false">邮箱验证码登录</a></li>
                    <li data-index="2" class=""><a href="###" data-target="#qrcodeForm" data-toggle="tab" aria-expanded="false">扫描登录</a></li>
                </ul>
                <div class="tab-content " style="background-color: #FFFFFF;">
                    <div class="tab-pane  active" id="loginFrom">
                        <div class="form-group">
                            <input type="text" id="username" class="form-control" placeholder="输入管理员帐号" required=""  >
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" class="form-control" placeholder="输入帐号密码" required="" >
                        </div>
                        <div class="form-group yzm-item" >
                            <input type="text" id="code" name="code" class="form-control" placeholder="输入图片验证码" style="width: 190px" required="">
                            <span class="form-explain"><img src="/api/captcha/get" style="margin-left: 75px;" class="yzm-img"></span>
                        </div>
                        <button type="button" class="btn btn-info block full-width m-b" style="background-color: #0071ce;" onclick="do_login()">登 录</button>
                    </div>
                    <div class="tab-pane " id="emaliForm">
                        <div class="tab-pane  active" id="loginFrom">
                            <div class="form-group">
                                <span class="btn" id="btn_send_mail" style="background-color: #0071ce;color:#FFFFFF;width: 120px;float: right;" > 获取邮箱验证码</span>
                                <input type="text" id="email" class="form-control" placeholder="请输入邮箱" required=""  style="width: 300px;">
                            </div>

                            <div class="form-group" >
                                <input type="text" id="email_code" class="form-control" placeholder="输入邮箱言验证码" required="" style="margin-top: 30px;">
                            </div>

                            <button type="button" class="btn btn-info block full-width m-b" onclick="email_login()" style="background-color: #0071ce">邮箱登录</button>
                        </div>
                    </div>
                    <div class="tab-pane " id="qrcodeForm">
                        <div>
                            <image src="http://mail.okfish.asia/static/admin/images/ding_ding.png" width="40px" height="40px"></image>
                            <button type="button" class="btn btn-info " onclick="bind_ding()" style="background-color: #0071ce;">钉钉扫描登录</button>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </div>
</div>
</body>
<!-- 全局js -->
<script src="<?=STATIC_URL?>js/jquery.min.js"></script>
<script src="<?=STATIC_URL?>js/bootstrap.min.js"></script>
<script  src="<?=STATIC_URL?>js/layer/layer.js"></script>

<script >
    $('.yzm-img').click(function(){
        var captcha_url = '/api/captcha/get?'+Date.parse(new Date());
        $('.yzm-img').attr('src',captcha_url);
    });
    layer.config({
        skin:'layer-ext-moon',
        extend:'moon/style.css'
    });
    $(document).ready(function() {
        $("#code").keydown(function(e) {
            var curKey = e.which;
            console.log(curKey);
            if (curKey == 13) {
                do_login();
                //  return false;
            }
        });
    });
    function email_login(){
        var email = $('#email').val();
        var email_code = $('#email_code').val();
        if(email==''){
            layer.msg('请填写用户名',{icon: 2});
            return false;
        }
        if(email_code==''){
            layer.alert('请填写密码',{icon: 2});
            return false;
        }

        var param ={
            email:email,
            email_code:email_code,
        };
        console.log(param);
        $.ajax({
            type:'POST',
            url:'/api/user/login_email',
            data:param,
            dataType:'json',
            success:function(data){
                console.log(data);
                if(data.status==0){
                    window.location.href = data.data.admin_url;
                }else{
                    layer.alert(data.msg, {icon: 2},function () {
                    });
                }
            }
        });
    }
    $('#btn_send_mail').click(function (){
        var email = $('#email').val();
        $.ajax({
            type: 'POST',
            url: '/admin/user/send_mail',
            data: {email:email},
            dataType: 'json',
            success: function (data) {
                layer.closeAll();
                if(data.status==0){

                    layer.alert(data.msg, {icon: 1},function () {});
                }else{
                layer.alert(data.msg, {icon: 2},function () {});
                }

            }
        });
    });
    function do_login(){
        var username = $('#username').val();
        var password = $('#password').val();
        var code = $('#code').val();
        if(username==''){
            layer.msg('请填写用户名',{icon: 2});
            return false;
        }
        if(password==''){
            layer.alert('请填写密码',{icon: 2});
            return false;
        }
        if(code==''){
            layer.alert('请填写验证码',{icon: 2});
            return false;
        }
        var param ={
            username:username,
            password:password,
            code:code,
        };
        console.log(param);
        $.ajax({
            type:'POST',
            url:'/api/user/login',
            data:param,
            dataType:'json',
            success:function(data){
                console.log(data);
                // $.cookie('admin_id',data.data.id,{'path':'/'});
                // $.cookie('username',data.data.username,{'path':'/'});
                // $.cookie('access_token',data.data.access_token,{'path':'/'});
                if(data.status==0){
                    window.location.href = data.data.admin_url;
                }else{
                    layer.alert(data.msg, {icon: 2},function () {
                        if(data.status!=0){
                            var captcha_url = '/api/captcha/get?'+Date.parse(new Date());
                            $('.yzm-img').attr('src',captcha_url);
                            layer.closeAll();
                        }
                    });
                }
            }
        });
    }

    function bind_ding() {
        layer.open({
            type: 2,
            title: '管理后台钉钉绑定',
            shadeClose: true,
            btn: ['确认','关闭'],
            area: ['500px', '500px'],
            content: '/admin/user/ding_admin_login',
            yes: function(index, layero){

            },btn2: function(index, layero){
                console.log('no');
            }
        });
    }
</script>
</html>

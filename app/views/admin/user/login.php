<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - 登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="<?=STATIC_URL?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/font-awesome.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/animate.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/style.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/screen.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?=STATIC_URL?>/js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>/js/respond.min.js"></script>
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg login-bg">
<div id="particles-js"></div>
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div class="logo-bg">
        <h1 class="logo-name"><img src="<?=STATIC_URL?>/images/logo.png" alt="服务器信息管理系统" width="234" height="234"></h1>
        <form class="m-t" role="form" id="form">
            <div class="form-group">
                <input type="text" id="username" class="form-control" placeholder="输入管理员帐号" required="">
            </div>
            <div class="form-group">
                <input type="password" id="password" class="form-control" placeholder="输入帐号密码" required="">
            </div>
            <button type="button" class="btn btn-info block full-width m-b" onclick="do_login()">登 录</button>

        </form>
    </div>
</div>
</body>
<!-- 全局js -->
<script src="<?=STATIC_URL?>/js/jquery.min.js"></script>
<script src="<?=STATIC_URL?>/js/jquery.cookie.js"></script>
<script src="<?=STATIC_URL?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=STATIC_URL?>/js/layer/layer.js"></script>
<script type="text/javascript">
    layer.config({
        skin:'layer-ext-moon',
        extend:'moon/style.css'
    });
    $(document).ready(function() {
        $("#password").keydown(function(e) {
            var curKey = e.which;
            console.log(curKey);
            if (curKey == 13) {
                do_login();
                //  return false;
            }
        });
    });
    function do_login(){
        var username = $('#username').val();
        var password = $('#password').val();

        if(username==''){
            layer.msg('请填写用户名',{icon: 2});
            return false;
        }
        if(password==''){
            layer.alert('请填写密码',{icon: 2});
            return false;
        }
        var param ={
            username:username,
            password:password,
        };
        $.ajax({
            type:'POST',
            url:'/api/user/login',
            data:param,
            dataType:'json',
            success:function(data){
                console.log(data);
                $.cookie('admin_id',data.data.id,{'path':'/'});
                $.cookie('username',data.data.username,{'path':'/'});
                $.cookie('access_token',data.data.access_token,{'path':'/'});
                if(data.status==0){
                    window.location.href = data.data.admin_url+'&'+$.param(data.data);
                }else{
                    layer.alert(data.msg, {icon: 2});
                }
            }
        });
    }
</script>

</html>

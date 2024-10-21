<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>主页</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--全局样式-->
    <link href="<?=STATIC_URL?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/style.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/screen.css" rel="stylesheet">
    <!--图标-->
    <link href="<?=STATIC_URL?>/css/font-awesome.min.css" rel="stylesheet">
    <!--导航-->
    <link href="<?=STATIC_URL?>/css/nav.css" rel="stylesheet">
    <!--导航-->
    <link href="<?=STATIC_URL?>/css/form.css" rel="stylesheet">
    <!--mobile 样式-->
    <link href="<?=STATIC_URL?>/css/mobile.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?=STATIC_URL?>/js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>/js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="gray-bg">
<div class="wrapper">
    <div class="navtop clearfix">
        <h1 class="nav-title">游戏管理后台<b></b></h1>
        <div class="navmenu"  id='cssmenu'>
            <ul class="navmenu-item">
                <li class="active"><a href="index.html">单服数据</a></li>
                <li><a href="index2.html">数据汇总</a></li>
                <li><a href="index3.html">运营功能</a></li>
                <li><a href="index4.html">服务器管理</a></li>
                <li><a href="index5.html">监控系统</a></li>
                <li><a href="">系统设置</a></li>
                <li><a href="">开发工具</a></li>
            </ul>
        </div>
        <div class="nav-right">
            Hi! <span class="user-item" id="admin_username"><?=$data['username']?><i class="fa fa-angle-down" aria-hidden="true"></i></span>
	<span class="user-con">
		<a href="#" class="a1" onclick="user_info('<?=$data['username']?>')"  id="username">账号修改</a>
		<a href="#" class="a2">安全退出</a>
	</span>
</span>
        </div>
    </div>
    <!--导航 end-->
    <div class="Business-back">
        <div class="Business-left left_0 transition clearfix">
            <div class="Website-nav">
                网站导航<div class="Slide-left transition"><i class="fa fa-outdent" aria-hidden="true"></div></i>
            </div>
            <ul class="list-unstyled left-Catalog" id="boxscroll">
                <li class="nav-toggle"><span class="nav-open"><i class="fa fa-bar-chart" aria-hidden="true"></i>数据概要</span>
                    <ul class="list-unstyled leftnav-view">
                        <li><a class="J_menuItem" href="serveroverview.html">服务器概况</a></li>
                        <li><a class="J_menuItem" href="dailysummary.html">每日汇总</a></li>
                    </ul>
                </li>
                <li class="nav-toggle"><span class="nav-open"><i class="fa fa-bar-chart" aria-hidden="true"></i>充值数据</span>
                    <ul class="list-unstyled leftnav-view">
                        <li><a class="J_menuItem" href="rechargelist.html">充值列表</a><strong>实时</strong></li>
                        <li><a class="J_menuItem" href="rechargeanalysis.html">充值分析</a></li>
                    </ul>
                </li>
                <li class="nav-toggle"><span class="nav-open"><i class="fa fa-bar-chart" aria-hidden="true"></i>在线数据</span>
                    <ul class="list-unstyled leftnav-view">
                        <li><a class="J_menuItem" href="currentonline.html">当前在线</a><strong>实时</strong></li>
                        <li><a class="J_menuItem" href="onlinedistribution.html">在线分析</a></li>
                    </ul>
                </li>
                <li class="nav-toggle"><span class="nav-open"><i class="fa fa-bar-chart" aria-hidden="true"></i>用户信息</span>
                    <ul class="list-unstyled leftnav-view">
                        <li><a class="J_menuItem" href="rolelist.html">角色列表</a></li>
                    </ul>
                </li>
                <li class="nav-toggle"><span class="nav-open"><i class="fa fa-bar-chart" aria-hidden="true"></i>数据分析</span>
                    <ul class="list-unstyled leftnav-view">
                        <li><a class="J_menuItem" href="totalretention.html">留存数据</a></li>
                        <li><a class="J_menuItem" href="copyparticipation.html">活跃分析</a></li>
                        <li><a class="J_menuItem" href="goldingot.html">消费分析</a></li>
                        <li><a href="#">游戏排行榜</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--左边 end-->
        <div class="Business-right transition clearfix">
            <iframe id="J_iframe" class="iframe-box" name="J_iframe" width="100%" height="100%" src="<?=$data['admin_url']?>" frameborder="0" data-id="index"></iframe>
        </div>
    </div>
</div>
<!-- 全局js -->
<script src="<?=STATIC_URL?>/js/jquery.min.js"></script>
<script src="<?=STATIC_URL?>/js/bootstrap.min.js"></script>
<!--导航-->
<script src="<?=STATIC_URL?>/js/nav.js"></script>
<!--滚动条美化-->
<script src="<?=STATIC_URL?>/js/jquery.nicescroll.js"></script>
<!--公共部分-->
<script src="<?=STATIC_URL?>/js/common.js"></script>
<script type="text/javascript" src="<?=STATIC_URL?>/js/layer/layer.js"></script>
<script type="text/javascript">
    layer.config({
        skin:'layer-ext-moon',
        extend:'moon/style.css'
    });
</script>
<script>
    $(document).ready(function() {
        $("#boxscroll").niceScroll({cursorborder:"",cursorcolor:"#999"});
    });


    function user_info(username) {
        var username_param = username;
        layer.open({
            type: 2,
            title: '修改密码',
            shadeClose: true,
            btn: ['确认','关闭'],
            area: ['300px', '300px'],
            content: '/admin/user/user_info',
            yes: function(index, layero){

                var body = layer.getChildFrame('body', index);
                var password = body.find('#password').val();
                var re_password = body.find('#re_password').val();
                console.log(password);
                var param ={
                    username:username_param,
                    password:password,
                    re_password:re_password
                };
                layer.load(2);
                $.ajax({
                    type:'POST',
                    url:'/api/user/update',
                    data:param,
                    dataType:'json',
                    success:function(data){
                        layer.close(2);
                        layer.alert(data.msg, {icon: 1},function(index){
                            layer.close(index);
                            layer.closeAll();
                        }
                        );
                    }
                });

            },btn2: function(index, layero){
                console.log('no');
            }
        });
    }
</script>
</body>
</html>
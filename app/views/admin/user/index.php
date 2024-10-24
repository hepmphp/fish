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
        <h1 class="nav-title">禅意花园<b></b></h1>
        <div class="navmenu"  id='cssmenu'>
            <ul class="navmenu-item">
                 <?php foreach ($top_menu as $k=>$m){?>
                <li <?php ($k==0)?'class="active"':''?>><a href="/<?=$m['model']?>/<?=$m['action']?>?<?=http_build_query($_GET)?>"><?=$m['name']?></a></li>
                <?php }?>
            </ul>
        </div>
        <div class="nav-right">
            Hi! <span class="user-item" id="admin_username"><?=$data['username']?><i class="fa fa-angle-down" aria-hidden="true"></i></span>
	<span class="user-con">
		<a href="#" class="a1" onclick="user_info('<?=$data['id']?>')"  id="username">账号修改</a>
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
                <? var_dump($left_menu_child);?>
                <?php foreach ($left_menu as $k=>$l_menu1){?>
                    <?php if(isset($l_menu1['name']) && !empty($l_menu1['name'])){?>
                <li class="nav-toggle"><span class="nav-open"><i class="fa fa-bar-chart" aria-hidden="true"></i><?=$l_menu1['name']?></span>
                   <?php }?>
                    <ul class="list-unstyled leftnav-view">

                        <?php foreach ($left_menu_child as $k2=>$l_menu2){
                            if($l_menu2['parentid']==$l_menu1['id']){
                        ?>
                        <li><a class="J_menuItem" href="/<?=$l_menu2['model']?>/<?=$l_menu2['action']?>?<?=http_build_query($_GET)?>&iframe=1"><?=$l_menu2['name']?></a></li>
                        <?php }}?>
                    </ul>
                </li>
                <?php }?>

            </ul>
        </div>
        <!--左边 end-->
        <div class="Business-right transition clearfix">
            <iframe id="J_iframe" class="iframe-box" name="J_iframe" width="100%" height="100%" src="<?=$data['admin_url']?>/?<?=http_build_query($_GET)?>&iframe=1" frameborder="0" data-id="index"></iframe>
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


    function user_info(id) {
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
                    id:id,
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
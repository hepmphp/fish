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
    <link href="<?=STATIC_URL?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>css/style.css?<?=rand()?>" rel="stylesheet">
    <link href="<?=STATIC_URL?>css/screen.css" rel="stylesheet">
    <!--图标-->
    <link href="<?=STATIC_URL?>css/font-awesome.min.css" rel="stylesheet">
    <!--导航-->
    <link href="<?=STATIC_URL?>css/nav.css" rel="stylesheet">
    <!--导航-->
    <link href="<?=STATIC_URL?>css/form.css" rel="stylesheet">
    <!--mobile 样式-->
    <link href="<?=STATIC_URL?>css/mobile.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?=STATIC_URL?>js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="gray-bg">
<div class="wrapper">
    <div class="navtop clearfix">
        <h1 class="nav-title">fish<b></b></h1>
        <div class="navmenu"  id='cssmenu'>
            <ul class="navmenu-item">
                 <?php foreach ($top_menu as $k=>$m){?>
                <li <?php if($m['top_menu_id']==$top_menu_id) {echo 'class="active"';}?>><a href="/<?=$m['model']?>/<?=$m['action']?>?iframe=0"><?=$m['name']?></a></li>
                <?php }?>
            </ul>
        </div>
        <div class="nav-right">
            Hi! <span class="user-item" id="admin_username"><?=$_SESSION['admin_user_username']?><i class="fa fa-angle-down" aria-hidden="true"></i></span>
	<span class="user-con">
		<a href="#" class="a1" onclick="user_info('<?=$_SESSION['admin_user_id']?>')"  id="username">密码修改</a>

		<a href="#" class="a2" onclick="user_logout()">安全退出</a>
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

                <?php foreach ($left_menu as $k=>$l_menu1){?>
                    <?php if(isset($l_menu1['name']) && !empty($l_menu1['name'])){?>
                <li class="nav-toggle"><span class="nav-open"><i class="fa fa-bar-chart" aria-hidden="true"></i><?=$l_menu1['name']?></span>
                   <?php }?>
                    <ul class="list-unstyled leftnav-view">

                        <?php foreach ($left_menu_child as $k2=>$l_menu2){
                            if($l_menu2['parentid']==$l_menu1['id'] ){
                        ?>
                        <li><a class="J_menuItem" href="/<?=$l_menu2['model']?>/<?=$l_menu2['action']?>?iframe=1"><?=$l_menu2['name']?></a></li>
                        <?php }}?>
                    </ul>
                </li>
                <?php }?>

            </ul>
        </div>
        <!--左边 end-->
        <div class="Business-right transition clearfix">
            <?php if(isset($data['admin_url']) && !empty($data['admin_url'])){ ?>
            <iframe id="J_iframe" class="iframe-box" name="J_iframe" width="100%" height="100%" src="<?=$data['admin_url']?>" frameborder="0" data-id="index"></iframe>
            <?php }?>
        </div>
    </div>
</div>

<!-- 全局js -->
<script src="<?=STATIC_URL?>js/jquery.min.js"></script>
<script src="<?=STATIC_URL?>js/bootstrap.min.js"></script>
<!--导航-->
<script src="<?=STATIC_URL?>js/nav.js"></script>
<!--滚动条美化-->
<script src="<?=STATIC_URL?>js/jquery.nicescroll.js"></script>
<!--公共部分-->
<script src="<?=STATIC_URL?>js/common.js"></script>
<script  src="<?=STATIC_URL?>js/layer/layer.js"></script>
<script>
    layer.config({
        skin:'layer-ext-moon',
        extend:'moon/style.css'
    });
</script>
<script>
    $(document).ready(function() {
        $("#boxscroll").niceScroll({cursorborder:"",cursorcolor:"#999"});
    });

    function user_logout(){
        layer.load(2);
        $.ajax({
            type:'POST',
            url:'/api/user/logout',
            data:{},
            dataType:'json',
            success:function(data) {
                layer.close(2);
                window.location.href = data.data.login_url;
            }
        });
    }
    



    function user_info(id) {
        window.location.href = '/admin/user/update_info?iframe=0&id='+id;
    }

</script>
</body>
<?php include_once WEB_PATH.'/../app/views/admin/user/debug.php'?>

</html>
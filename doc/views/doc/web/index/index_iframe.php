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
        <h1 class="nav-title">文件管理<b></b></h1>
        <div class="navmenu"  id='cssmenu'>
            <ul class="navmenu-item">
            </ul>
        </div>
        <div class="nav-right">
            Hi! <span class="user-item" id="admin_username"><?=$_SESSION['doc_user_username']?><i class="fa fa-angle-down" aria-hidden="true"></i></span>
            <span class="user-con">
		<a href="#" class="a1" onclick="update_info()"  id="username">菜单</a>

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
                    <li class="nav-toggle"><span class="nav-open"><i class="fa fa-bar-chart" aria-hidden="true">文件管理</i></span>
                    <ul class="list-unstyled leftnav-view">
                        <li><a class="J_menuItem" href="/doc.php/web/file/index">文件列表</a></li>
                    </ul>
                    </li>
            </ul>
        </div>
        <!--左边 end-->
        <div class="" style="width: 1730px;height:800px;margin-left: 165px;">
                <iframe id="J_iframe" class="iframe-box" name="J_iframe" width="100%" height="100%" src="<?=$form['admin_url']?>" frameborder="0" data-id="index"></iframe>
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
    function update_info(){
        window.location.href = '/doc.php/web/user/info';
    }
    function user_logout(){
        layer.load(2);
        $.ajax({
            type:'POST',
            url:'/doc.php/web/user/logout',
            data:{},
            dataType:'json',
            success:function(data) {
                layer.close(2);
                window.location.href = '/doc.php';
            }
        });
    }




    function user_info(id) {
        window.location.href = '/admin/user/update_info?iframe=0&id='+id;
    }
    /*退出账号*/
    $(function(){
        $('.user-item').click(function(){
            $('.user-con').slideToggle();
        })
    })
    /*左侧导航*/
    $(".list-teggol").on("click",function () {
        $('.Computer-infor').hide();
        $('.ssion-dd').stop();
        $(this).parent().siblings('dt').removeAttr('id');
        if($(this).parent().attr('id')=='open'){
            $(this).parent().removeAttr('id').siblings('dd').slideUp();
        }else{
            $(this).parent().attr('id','open').next().slideToggle().siblings('dd').slideUp().siblings('dt');
        }
    });
</script>
</body>

</html>


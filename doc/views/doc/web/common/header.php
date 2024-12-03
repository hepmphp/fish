<?php \app\helpers\AppAsset::run()?>
<script >
    layer.config({
        skin: 'layer-ext-moon',
        extend: 'moon/style.css'
    });
</script>
<link href="  http://127.0.0.1/static/admin/css/nav.css" rel="stylesheet">
<style>
    .nav-title {
        margin-right: 5px;
        height: 42px;
        width: 300px;
        display: inline-block;
        vertical-align: middle;
        position: absolute;
        left: -70px;
        color: #FFFFFF;

    }
    .form-body h1{
        font-size: 24px;
        color: #FFFFFF;
        font-weight: bold;
    }
</style>
<script>
    /*退出账号*/
    $(function(){
        $('.user-item').click(function(){
            $('.user-con').slideToggle();
        })
    })
    function user_logout(){
        layer.load(2);
        $.ajax({
            type:'POST',
            url:'/doc.php/web/user/logout',
            data:{},
            dataType:'json',
            success:function(data) {
                layer.close(2);
                window.location.href = '/doc.php/web/user/login';
            }
        });
    }
    function user_info(id) {
        window.location.href = '/doc.php/web/user/info?iframe=0&id='+id;
    }

</script>
<div class="navtop clearfix" style="height: 60px;">
    <a href="/doc.php">   <h1 class="nav-title" style="margin-top: 0;"> 文件管理</h1></a>
    <div class="nav-right">
        尊敬的用户 <span class="user-item" id="admin_username"><?=$_SESSION['doc_user_username']?><i class="fa fa-angle-down" aria-hidden="true"></i></span>
        <span class="user-con">
		<a href="#" class="a1" onclick="user_info('<?=$_SESSION['doc_user_id']?>')" id="username">密码修改</a>

		<a href="#" class="a2" onclick="user_logout()">安全退出</a>
	    </span>

    </div>
</div>
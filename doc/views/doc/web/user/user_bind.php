<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?= STATIC_URL ?>js/html5shiv.min.js"></script>
    <script src="<?= STATIC_URL ?>js/respond.min.js"></script>
    <![endif]-->
    <?php \app\helpers\AppAsset::run()?>
    <script >
        layer.config({
            skin: 'layer-ext-moon',
            extend: 'moon/style.css'
        });
    </script>

</head>

<body class="form-body">
<?php include DOC_PATH . 'views/doc/web/common/header.php' ?>
<div class="form-wrapper" style="padding-top: 0;margin-top: 5px;">
    <ul class="list-inline page-tab clearfix">
        <li><a href="/doc.php/web/user/info?iframe=1">修改用户信息</a><em></em></li>
        <li  class="cur"><a href="/doc.php/web/user/user_bind?iframe=1">用户信息绑定</a><em></em></li>
    </ul>
    <div class="form-item">
        <div class="form-main">
            <?php if(!empty($_SESSION['doc_user_id'])){
                $form['id'] = $_SESSION['doc_user_id'];
                $form['username'] = $_SESSION['doc_user_username'];

            }?>
            <div class="form-inline" style="margin-left: -10px;">
                <div class="form-group">
                    <label class="control-label">用户名：</label>
                    <span><?=$form['username']?></span>
                </div>
            </div>
            <div class="row">
                <div class="col" style="float: left">
                    <div class="form-inline" style="width: 260px;">
                        <img src="<?=STATIC_URL?>image/ding_ding.png" width="40px" height="40px">
                        <button type="button" class="btn btn-info " onclick="bind_ding(<?=$form['id']?>)" style="background-color: #0071ce;margin-left: 10px;margin-top: 8px;">钉钉扫描登录</button>
                    </div>
                    <div class="form-inline" style="width: 260px;">
                        <img src="<?=STATIC_URL?>image/bind_email.png" width="50px" height="50px" style="margin-left: -5px;">
                        <button type="button" class="btn btn-info " onclick="bind_email(<?=$form['id']?>)" style="background-color: #0071ce;margin-left: 10px;margin-top: 8px;margin-left: 5px;">邮箱绑定登录</button>
                    </div>


        </div>

        </div>

    </div>
    <?php \app\helpers\AppAsset::run_javascript_end()?>
</body>
<script>
function bind_ding(id) {
layer.open({
    type: 2,
    title: '钉钉绑定',
    shadeClose: true,
    btn: ['确认','关闭'],
    area: ['500px', '500px'],
    content: '/doc.php/web/user/ding_login?id='+id,
    yes: function(index, layero){


    },btn2: function(index, layero){
        console.log('no');
    }
});
}
function bind_wexin() {
layer.open({
    type: 2,
    title: '支付宝绑定',
    shadeClose: true,
    btn: ['确认','关闭'],
    area: ['500px', '500px'],
    content: '/doc.php/web/user/login_weixin',
    yes: function(index, layero){


    },btn2: function(index, layero){
        console.log('no');
    }
});
}
function bind_email(id) {
layer.open({
    type: 2,
    title: '绑定邮箱',
    shadeClose: true,
    btn: ['确认','关闭'],
    area: ['800px', '500px'],
    content: '/doc.php/web/user/email?id='+id,
    yes: function(index, layero){
        var body = layer.getChildFrame('body', index);
        var id = body.find('#id').val();
        var email = body.find('#email').val();
        var email_code = body.find('#email_code').val();
        var param ={
            id:id,
            email:email,
            email_code:email_code
        };
        console.log(param)
        layer.load(2);
        $.ajax({
            type:'POST',
            url:'/doc.php/web/user/bind_email',
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
</html>



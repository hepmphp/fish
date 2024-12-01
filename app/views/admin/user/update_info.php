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
<div class="form-wrapper" style="padding-top: 0">
    <ul class="list-inline page-tab clearfix">
        <li ><a href="/admin/user/index?iframe=1">用户列表</a><em></em></li>
        <li class="cur"><a href="/admin/user/update_info?iframe=1">修改用户密码</a><em></em></li>
        <li ><a href="/admin/user/user_bind?iframe=1">用户信息绑定</a><em></em></li>
    </ul>
    <div class="form-item">

        <div class="form-main">
            <div class="row">
                <?php if(!empty($_SESSION['admin_user_id'])){
                    $form['id'] = $_SESSION['admin_user_id'];
                    $form['username'] = $_SESSION['admin_user_username'];

                }?>

                <input type="hidden" id="id" value="<?=$form['id']?>">
                <div class="col" style="float: left">
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">用户名：&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <span><?=$form['username']?></span>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">密码:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="password" id="password" style="width: 250px" class="form-control">
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">再次输入：</label>
                            <input type="password" id="re_password" style="width: 250px" class="form-control">
                        </div>
                    </div>

                </div>

            </div>
                <button class="btn btn-info m-l-74" type="button" id="btn_update_info"> 确认修改</button>
        </div>


    </div>
    <?php \app\helpers\AppAsset::run_javascript_end()?>
</body>
<script>
   console.log( parent.$('.leftnav-view').find('li').find('a').each(function () {
       if($(this).text()=='用户列表'){
           $(this).parent().addClass('on');
       }
   }));
    $('#btn_update_info').click(function(){
        var id =$('#id').val();
        var password = $('#password').val();
        var re_password = $('#re_password').val();
        var param ={
            id:id,
            password:password,
            re_password:re_password
        };
        console.log(param);
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
    });

</script>
</html>

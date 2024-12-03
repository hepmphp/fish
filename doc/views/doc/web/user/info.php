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
        <li class="cur"><a href="/doc.php/web/user/info?iframe=1">修改用户信息</a><em></em></li>
        <li ><a href="/doc.php/web/user/user_bind?iframe=1">用户信息绑定</a><em></em></li>
    </ul>
    <div class="form-item">

        <div class="form-main">
            <div class="row">
                <?php if(!empty($_SESSION['doc_user_id'])){
                    $form['id'] = $_SESSION['doc_user_id'];
                    $form['username'] = $_SESSION['doc_user_username'];

                }?>

                <input type="hidden" id="id" value="<?=$form['id']?>">
                <div class="col" style="float: left">
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="control-label">用户名：&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <span><?=$form['username']?></span>
                        </div>
                    </div>
                    <link href="<?= STATIC_URL ?>js/upload/css/image.css" rel="stylesheet">
                    <link href="<?= STATIC_URL ?>js/upload/css/iconfont.css" rel="stylesheet">
                    <div class="form-inline">
                    <div class="form-group">
                        <label class="control-label">图片：</label>
                        <div class="col-sm-4" style="width: 400px;">
                            <div class="upload-win">
                                <div class="upload-img upload-img-mutil left">
                                    <img src="" alt=""  class="pic_url">
                                    <span class="image-item" src=""></span>
                                    <input type="file" name="images" class="images" style="opacity:0" accept="image/*" capture="camera">
                                    <i class="iconfont icon-lajitong"></i>
                                    <i class="iconfont icon-tianjia"></i>
                                    <div class="over-cover"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <script>
                        var upload_api = "<?='http://'.$_SERVER['HTTP_HOST'].'/doc.php/api/uploader/index';?>";
                         var images_list = <?php echo json_encode($form['avator']); ?>;
                        //  var str='<div class="upload-img  upload-img-mutil left"><span class="image-item"></span><img src="" alt=""><input type="file" name="images" style="opacity:0" accept="image/*" capture="camera"/><i class="iconfont icon-lajitong"></i><i class="iconfont icon-tianjia"></i><div class="over-cover"></div></div>';
                        console.log(images_list);
                        $.each(images_list,function (i,v){
                            $('.image-item').eq(i).attr('src',v);
                            $('.image-item').eq(i).attr('value',v);
                        });
                        $.each(image_list_url,function (i,v){
                            $('.pic_url').eq(i).attr('src',v);
                        });
                        // $(".upload-win").append(str);
                    </script>
                    <script id="upload_js" src="<?= STATIC_URL ?>js/upload/js/uploader.js"></script>
                    <div class="form-inline" STYLE="margin-top: 30px;">
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
            url:'/doc.php/web/user/info',
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

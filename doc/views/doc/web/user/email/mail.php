<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>区服开启</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?=STATIC_URL?>js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>js/respond.min.js"></script>
    <![endif]-->
    <?=\app\helpers\AppAsset::run()?>
    <script >
        layer.config({
            skin: 'layer-ext-moon',
            extend: 'moon/style.css'
        });
    </script>
</head>
<body>
<div class="form-horizontal">
    <div class="" style="width: 600px;margin:60px auto;margin-top: 100px;margin-left:200px; ">
        <?php if(!empty($_SESSION['doc_user_id'])){
            $form['id'] = $_SESSION['doc_user_id'];
            $form['username'] = $_SESSION['doc_user_username'];

        }?>
        <input type="hidden" id="id" value="<?=$form['id']?>">
        <div class="form-inline">
            <div class="form-inline">
                <div class="form-group">
                    <label class="control-label">用户名：&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <span><?=$form['username']?></span>
                </div>
            </div>
        </div>
        <div class="form-inline" style="margin-top: 10px;">
            <div class="form-group">
                <label class="control-label">邮箱： &nbsp;&nbsp;&nbsp; </label>
                <input type="text" id="email" class="form-control" style="width: 300px !important;" >
                <a class="btn btn-info m-l" id="btn_send_mail" style="background-color: #0071ce;color:#FFFFFF;"> 获取验证码</a>
            </div>
        </div>
        <div class="form-inline" style="margin-top: 10px;">
            <div class="form-group">
                <label class="control-label">验证码：</label>
                <input type="text" id="email_code" class="form-control" style="width: 300px !important;" >
            </div>
        </div>
    </div>
</div>
</body>
<?=\app\helpers\AppAsset::run_javascript_end()?>
 <script>
     $('#btn_send_mail').click(function (){
         var id =$('#id').val();
         var email = $('#email').val();
         $.ajax({
             type: 'POST',
             url: '/doc.php/web/user/send_mail',
             data: {id:id,email:email},
             dataType: 'json',
             success: function (data) {
                 layer.closeAll();
                 if(data.status==0){
                     layer.alert(data.msg, {icon:1}, function(){
                     });
                 }else{
                     layer.alert(data.msg, {icon:2}, function(){
                 });
             }

             }
         });
     });
 </script>
</html>
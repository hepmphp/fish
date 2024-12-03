<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>密码重置链接已经发到你的邮箱</title>
    <link href="<?=STATIC_URL?>css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>css/commom.css" rel="stylesheet" type="text/css" />
    <link href="<?=STATIC_URL?>css/register.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?=STATIC_URL?>js/jquery.min.js"></script>
</head>
<body>
<div class="aw-register-box">
    <div class="mod-head">

    </div>
    <div class="mod-body">
        <h1>密码重置链接已经发到你的邮箱 <?=$email?></h1>
        <div>
            <?php
             $email_url = explode('@',$email);
             $email_url_href = 'http://mail.'.$email_url[1];
            ?>
            <a href="<?=$email_url_href?>">邮箱链接<?=$email_url_href?></a>
        </div>
    </div>
</div>
</body>

</html>
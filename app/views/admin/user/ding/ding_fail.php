<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - 登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="<?=STATIC_URL?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>css/font-awesome.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>css/animate.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>css/style.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>css/screen.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?=STATIC_URL?>js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>js/respond.min.js"></script>
    <![endif]-->
    <!-- 全局js -->
    <script src="<?=STATIC_URL?>js/jquery.min.js"></script>
    <script  src="<?=STATIC_URL?>js/layer/layer.js"></script>
</head>

<body>
<script>
    layer.msg('管理后台绑定钉钉扫描成功', {
        icon: 1,
        time:3000,
        //time: 50000, //2秒关闭（如果不配置，默认是3秒）,
    },function() {
        index = parent.layer.getFrameIndex(window.name);//获取窗口索引
        parent.layer.close(index);// 关闭layer
    });

</script>

</body>

</html>

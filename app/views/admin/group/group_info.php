<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>区服开启</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--全局样式-->
    <link href="<?=STATIC_URL?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/style.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/screen.css" rel="stylesheet">
    <!--图标-->
    <link href="<?=STATIC_URL?>/css/font-awesome.min.css" rel="stylesheet">
    <!--表单表格-->
    <link href="<?=STATIC_URL?>/js/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>/css/form.css" rel="stylesheet">
    <!--日期-->
    <link href="<?=STATIC_URL?>/js/date/daterangepicker.css" rel="stylesheet">
    <!--mobile 样式-->
    <link href="<?=STATIC_URL?>/css/mobile.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?=STATIC_URL?>/js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="form-item">
    <form class="clearfix" role="form">
        <input type="hidden" id="id" value="<?=$form['id']?>">
        <div class="form-group">
            <label class="control-label">分组名称：</label>
            <input  class="form-control int180" type="text" id="name" value="<?=$form['name']?>">
        </div>
        <div class="form-group">
            <label class="control-label">分组说明：</label>
            <textarea class="form-control" rows="4" id="comment"><?=$form['comment']?></textarea>
        </div>
        <div class="form-group">
            <input name="allow_mutil_login" id="allow_mutil_login" type="checkbox" <?php if($form['allow_mutil_login']==1){?>checked="checked"<?php }?> value="1">
            <label class="control-label">多人同时登录</label>
        </div>
    </form>
</div>
</body>
<!-- 全局js -->
<script src="<?=STATIC_URL?>/js/jquery.min.js"></script>
<script src="<?=STATIC_URL?>/js/bootstrap.min.js"></script>
<!-- Bootstrap table -->
<script src="<?=STATIC_URL?>/js/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?=STATIC_URL?>/js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>

</html>
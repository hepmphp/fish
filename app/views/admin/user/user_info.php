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
<div class="form-wrapper">
    <div class="form-item min-pop" style="width: 300px;margin:10px auto;">
        <div class="form-inline">
            <div class="form-group">
                <label class="control-label">密码：</label>
                <input type="password" id="password" style="width: 150px" class="form-control">
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group">
                <label class="control-label">再次输入：</label>
                <input type="password" id="re_password" style="width: 150px" class="form-control">
            </div>
        </div>
    </div>
</div>
</body>
<!-- 全局js -->
<script src="<?=STATIC_URL?>/js/jquery.min.js"></script>
<script src="<?=STATIC_URL?>/js/bootstrap.min.js"></script>
<!-- Bootstrap table -->
<script src="<?=STATIC_URL?>/js/bootstrap-table/bootstrap-table.min.js"></script>
<script src="<?=STATIC_URL?>/js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
 
</html>
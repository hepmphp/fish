<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title></title>
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

<div class="container col-sm-12"  style="margin-top: 10px;">
    <form class="form-horizontal" >
        <input type="hidden" id="id" value="<?=$form['id']?>">
        <!-- Select Basic -->
        <div class="form-group inline-block">
            <label class="col-sm-4 control-label" for="parentid">上级</label>
            <div class="col-sm-4">
                <select id="parentid" name="parentid" class="form-control">
                    <option value="0">作为一级菜单</option>
                    <?=$config_menu?>
                </select>
            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-sm-4 control-label" for="name">菜单名称</label>
            <div class="col-sm-4">
                <input id="name" name="name" value="<?=$form['name']?>" type="text" placeholder="菜单名称" class="form-control input-md">

            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-sm-4 control-label" for="model">控制器</label>
            <div class="col-sm-4">
                <input id="model" name="model"  value="<?=$form['model']?>" type="text" placeholder="控制器" class="form-control input-md">
            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-sm-4 control-label" for="action">方法</label>
            <div class="col-sm-4">
                <input id="action" name="action"  value="<?=$form['action']?>" type="text" placeholder="方法" class="form-control input-md">

            </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-sm-4 control-label" for="data">参数</label>
            <div class="col-sm-4">
                <input id="data" name="data"  value="<?=$form['data']?>" type="text" placeholder="参数" class="form-control input-md">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group inline-block">
            <label class="col-sm-4 control-label" for="listorder">排序</label>
            <div class="col-sm-4">
                <input id="listorder" name="listorder"  value="<?=$form['listorder']?>" type="text" placeholder="排序" class="form-control input-md">

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-sm-4 control-label" for="remark">备注</label>
            <div class="col-sm-4">
                <input id="remark" name="remark"  value="<?=$form['remark']?>" type="text" placeholder="备注" class="form-control input-md">

            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-sm-4 control-label" for="status">状态</label>
            <div class="col-sm-4">
                <select id="status" name="status" class="form-control">
                    <option value="0" <?php if($vo['status']==$form['status']){ echo "selected";}?>>正常</option>
                    <option value="-1" <?php if($vo['status']==$form['status']){ echo "selected";}?>>隐藏</option>
                </select>
            </div>
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
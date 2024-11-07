<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?=STATIC_URL?>js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>js/respond.min.js"></script>
    <![endif]-->
    <?php \app\helpers\AppFormAsset::run()?>
</head>
<body>
<div class="container col-sm-12" style="margin-top: 10px;">
    <div class="form-horizontal">
        <input type="hidden" id="id" value="<?=$form['id']?>">
        <div class="form-group">
            <label class="col-sm-4 control-label" for="parentid">父级id</label>
            <div class="col-sm-4">
                <select id="parentid" name="parentid" class="form-control">
                    <option value="0">顶级菜单</option>
                    <?=$select_tree?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label" for="name">名称</label>
            <div class="col-sm-4">
                <input id="name" name="name" type="text" value="<?=$form['name']?>" placeholder="名称" class="form-control input-md">
            </div>
        </div>
        <style>
            .image_list_class{
                margin-left: 240px;
            }
        </style>
        <?php include APP_PATH.'/views/admin/root/upload.php';?>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="level">层级</label>
            <div class="col-sm-4">
                <input id="level" name="level" type="text" value="<?=$form['level']?>" placeholder="层级" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="status">状态</label>
            <div class="col-sm-4">
                <select id="status" name="status" class="form-control">
                    <option value="">请选择</option>
                    <?php
                    foreach($config_status as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php if($vo['id']==$form['status'] && is_numeric($vo['id'])){ echo "selected";}?>><?=$vo['name']?></option>
                    <?php }?>
                </select>
            </div>
        </div>


    </div>
</div>

</body>
<?php \app\helpers\AppFormAsset::run_javascript_end()?>
</html>
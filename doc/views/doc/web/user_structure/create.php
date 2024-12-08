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
        <?php if(strpos($_SERVER['REQUEST_URI'],'create')!==false){?>
            <input type="hidden" id="action" value="create">
        <?php }else{?>
            <input type="hidden" id="action" value="update">
        <?php }?>
        <input type="hidden" id="id" value="<?=$form['id']?>">
        <div class="form-group inline-block">
            <label class="col-sm-4 control-label" for="tree_node_id">树形结构名称</label>
            <div class="col-sm-4">
                <select id="tree_node_id" name="parentid" class="form-control">
                    <option value="0">作为一级菜单</option>
                    <?=$tree_node_config_menu?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="name">菜单名称</label>
            <div class="col-sm-4">
                <input id="name" name="name" type="text" value="<?=$form['name']?>" placeholder="菜单名称" class="form-control input-md">
            </div>
        </div>
        <?php include DOC_PATH.'/views/doc/web/user_structure/upload.php';?>
        <div class="form-group inline-block">
            <label class="col-sm-4 control-label" for="parentid">上级</label>
            <div class="col-sm-4">
                <select id="parentid" name="parentid" class="form-control">
                    <option value="0">作为一级菜单</option>
                    <?=$config_menu?>
                </select>
            </div>
        </div>
        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-sm-4 control-label" for="status">菜单状态</label>
            <div class="col-sm-4">
                <select id="status" name="status" class="form-control">
                    <option value="">请选择</option>
                    <?php
                    foreach($config_status as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php if($vo['id']==$form['status'] && is_numeric($form['status'])){ echo "selected";}?>><?=$vo['name']?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="remark">标题</label>
            <div class="col-sm-4">
                <input id="title" name="title" type="text" value="<?=$form['title']?>" placeholder="标题" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="level">菜单级别 0 1 2 3 4 依次递增</label>
            <div class="col-sm-4">
                <input id="level" name="level" type="text" value="<?=$form['level']?>" placeholder="菜单级别 0 1 2 3 4 依次递增" class="form-control input-md">
            </div>
        </div>

    </div>
</div>

</body>
<?php \app\helpers\AppFormAsset::run_javascript_end()?>
</html>
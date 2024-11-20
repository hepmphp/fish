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

        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-sm-4 control-label" for="admin_id">管理员</label>
          <div class="col-sm-4">
            <select id="admin_id" name="admin_id" class="form-control">
              <option value="">请选择</option>
                <?php
                    foreach($config_admin_id as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php if($vo['id']==$form['admin_id'] && is_numeric($form['admin_id'])){ echo "selected";}?>><?=$vo['username']?></option>
                    <?php }?>
            </select>
          </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-sm-4 control-label" for="project_id">项目</label>
          <div class="col-sm-4">
            <select id="project_id" name="project_id" class="form-control">
              <option value="">请选择</option>
                <?php
                    foreach($config_project_id as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php if($vo['id']==$form['project_id'] && is_numeric($form['project_id'])){ echo "selected";}?>><?=$vo['name']?></option>
                    <?php }?>
            </select>
          </div>
        </div>
    </div>
</div>

</body>
<?php \app\helpers\AppFormAsset::run_javascript_end()?>
</html>
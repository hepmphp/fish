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
<div class="container col-sm-12" style="padding-top: 10px;">
    <div class="form-horizontal">
        <input type="hidden" id="id" value="<?=$form['id']?>">

       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="admin_id">申请人员id</label>
          <div class="col-sm-4">
          <input id="admin_id" name="admin_id" type="text" value="<?=$form['admin_id']?>" placeholder="申请人员id" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="deploy_admin_id">发布人员id</label>
          <div class="col-sm-4">
          <input id="deploy_admin_id" name="deploy_admin_id" type="text" value="<?=$form['deploy_admin_id']?>" placeholder="发布人员id" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="project_id">项目id</label>
          <div class="col-sm-4">
          <input id="project_id" name="project_id" type="text" value="<?=$form['project_id']?>" placeholder="项目id" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="project_name">项目名称</label>
          <div class="col-sm-4">
          <input id="project_name" name="project_name" type="text" value="<?=$form['project_name']?>" placeholder="项目名称" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="file_list">文件列表</label>
          <div class="col-sm-4">
          <input id="file_list" name="file_list" type="text" value="<?=$form['file_list']?>" placeholder="文件列表" class="form-control input-md">
          </div>
       </div>
        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-sm-4 control-label" for="status">发布状态</label>
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
          <label class="col-sm-4 control-label" for="rsync_log">rsync同步日志</label>
          <div class="col-sm-4">
          <input id="rsync_log" name="rsync_log" type="text" value="<?=$form['rsync_log']?>" placeholder="rsync同步日志" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="comment">发布备注</label>
          <div class="col-sm-4">
          <input id="comment" name="comment" type="text" value="<?=$form['comment']?>" placeholder="发布备注" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="rollback_comment">还原备注</label>
          <div class="col-sm-4">
          <input id="rollback_comment" name="rollback_comment" type="text" value="<?=$form['rollback_comment']?>" placeholder="还原备注" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="addtime">添加时候</label>
          <div class="col-sm-4">
          <input id="addtime" name="addtime" type="text" value="<?=$form['addtime']?>" placeholder="添加时候" class="form-control input-md">
          </div>
       </div>

    </div>
</div>

</body>
<?php \app\helpers\AppFormAsset::run_javascript_end()?>
</html>
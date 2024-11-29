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
          <label class="col-sm-4 control-label" for="stmp_server">stmp邮箱主机名</label>
          <div class="col-sm-4">
          <input id="stmp_server" name="stmp_server" type="text" value="<?=$form['stmp_server']?>" placeholder="stmp邮箱主机名" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="imap_server">stmp邮箱主机名</label>
          <div class="col-sm-4">
          <input id="imap_server" name="imap_server" type="text" value="<?=$form['imap_server']?>" placeholder="stmp邮箱主机名" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="stmp_port">smtp端口号</label>
          <div class="col-sm-4">
          <input id="stmp_port" name="stmp_port" type="text" value="<?=$form['stmp_port']?>" placeholder="smtp端口号" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="imap_port">imap端口号</label>
          <div class="col-sm-4">
          <input id="imap_port" name="imap_port" type="text" value="<?=$form['imap_port']?>" placeholder="imap端口号" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="username">账号</label>
          <div class="col-sm-4">
          <input id="username" name="username" type="text" value="<?=$form['username']?>" placeholder="账号" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="password">密码</label>
          <div class="col-sm-4">
          <input id="password" name="password" type="text" value="<?=$form['password']?>" placeholder="密码" class="form-control input-md">
          </div>
       </div>

        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-sm-4 control-label" for="status">状态</label>
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

    </div>
</div>

</body>
<?php \app\helpers\AppFormAsset::run_javascript_end()?>
</html>
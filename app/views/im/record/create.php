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
          <label class="col-sm-4 control-label" for="from_id">发送者id</label>
          <div class="col-sm-4">
          <input id="from_id" name="from_id" type="text" value="<?=$form['from_id']?>" placeholder="发送者id" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="to_id">接收者id</label>
          <div class="col-sm-4">
          <input id="to_id" name="to_id" type="text" value="<?=$form['to_id']?>" placeholder="接收者id" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="from_username">消息发送者id</label>
          <div class="col-sm-4">
          <input id="from_username" name="from_username" type="text" value="<?=$form['from_username']?>" placeholder="消息发送者id" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="to_username">消息接收者id</label>
          <div class="col-sm-4">
          <input id="to_username" name="to_username" type="text" value="<?=$form['to_username']?>" placeholder="消息接收者id" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="content">发送内容</label>
          <div class="col-sm-4">
          <input id="content" name="content" type="text" value="<?=$form['content']?>" placeholder="发送内容" class="form-control input-md">
          </div>
       </div>
        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-sm-4 control-label" for="type">聊天类型</label>
          <div class="col-sm-4">
            <select id="type" name="type" class="form-control">
              <option value="">请选择</option>
                <?php
                    foreach($config_type as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php if($vo['id']==$form['type'] && is_numeric($form['type'])){ echo "selected";}?>><?=$vo['name']?></option>
                    <?php }?>
            </select>
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
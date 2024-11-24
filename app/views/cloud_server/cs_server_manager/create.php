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
    <?php \app\helpers\AppAsset::run()?>
</head>
<body>
<div class="container col-sm-12" style="margin-top: 10px;">
    <div class="form-horizontal">
        <input type="hidden" id="id" value="<?=$form['id']?>">

        <div class="form-group">
          <label class="col-sm-4 control-label" for="host">主机</label>
          <div class="col-sm-4">
          <input id="host" name="host" type="text" value="<?=$form['host']?>" placeholder="主机" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="port">端口号</label>
          <div class="col-sm-4">
          <input id="port" name="port" type="text" value="<?=$form['port']?>" placeholder="端口号" class="form-control input-md">
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
        <div class="form-group">
          <label class="col-sm-4 control-label" for="expire_time">账号过期时间</label>
          <div class="col-sm-4">
          <input id="expire_time" name="expire_time" type="text" value="<?=$form['expire_time']?>" placeholder="账号过期时间" class="form-control input-md date-range date-ico">
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
<?php \app\helpers\AppAsset::run_javascript_end()?>
<style>
    .date-picker-wrapper .footer {
        display: none;
        font-size: 11px;
        padding-top: 3px;
    }
</style>
<script >
    $('.date-range').dateRangePicker(
        {
            startDate: moment(), // 起始日期
            autoClose: true,
            singleDate : true,
            singleMonth: true,
            showShortcuts: false,
            startOfWeek: 'monday',
            format: 'YYYY-MM-DD',

        });
    $(function () { $(".popover-options a").popover({
        html : true
    });});

</script>
</html>
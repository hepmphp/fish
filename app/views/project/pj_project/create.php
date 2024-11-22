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
          <label class="col-sm-4 control-label" for="title">标题</label>
          <div class="col-sm-4">
          <input id="title" name="title" type="text" value="<?=$form['title']?>" placeholder="标题" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="descption">描述</label>
          <div class="col-sm-4">
          <input id="descption" name="descption" type="text" value="<?=$form['descption']?>" placeholder="描述" class="form-control input-md">
          </div>
       </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="priority">优先级</label>
            <div class="col-sm-4">
                <select id="priority" name="priority" class="form-control">
                    <option value="">请选择</option>
                    <?php
                    foreach($config_priority as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php if($vo['id']==$form['priority'] && is_numeric($form['priority'])){ echo "selected";}?>><?=$vo['name']?></option>
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
        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-sm-4 control-label" for="admin_id">管理员id</label>
          <div class="col-sm-4">
            <select id="admin_id" name="admin_id" class="form-control">
              <option value="">请选择</option>
                <?php
                    foreach($config_admin_user as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php if($vo['id']==$form['admin_id'] && is_numeric($form['admin_id'])){ echo "selected";}?>><?=$vo['username']?></option>
                    <?php }?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label" for="owner_user_id">指派的用户id</label>
          <div class="col-sm-4">
            <select id="owner_user_id" name="owner_user_id" class="form-control">
              <option value="">请选择</option>
                <?php
                    foreach($config_admin_user as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php if($vo['id']==$form['owner_user_id'] && is_numeric($form['owner_user_id'])){ echo "selected";}?>><?=$vo['username']?></option>
                    <?php }?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="hours">计划工时</label>
          <div class="col-sm-4">
          <input id="hours" name="hours" type="number" value="<?=$form['hours']?>" placeholder="计划工时" class="form-control input-md">
          </div>
       </div>
       <div class="form-group">
		<label class="control-label col-sm-4">开始日期：</label>
		  <div class="col-sm-4">
		<input placeholder="开始日期" class="form-control date-range date-ico  form-date" name="start_date" id="start_date"  type="text" value="<?php if(!empty($form['start_date'])){echo $form['start_date'];}?>">
		</div>
	   </div>
       <div class="form-group">
		<label class="control-label col-sm-4">截止日期：</label>
		  <div class="col-sm-4">
		<input placeholder="截止日期" class="form-control date-range date-ico  form-date" name="end_date" id="end_date"  type="text" value="<?php if(!empty($form['end_date'])){echo $form['end_date'];}?>">
		</div>
	   </div>

    </div>
</div>

</body>
<?php \app\helpers\AppAsset::run_javascript_end()?>
<script >
    $('.date-range').dateRangePicker(
        {
            separator: ' to ',
            format: 'YYYY-MM-DD',
            // endDate: moment(),
            getValue: function () {

                if ($('#start_date').val() && $('#end_date').val())
                    return $('#start_date').val() + ' 至 ' + $('#end_date').val();
                else
                    return '';
            },
            setValue: function (s, s1, s2) {
                $('#start_date').val(s1);
                $('#end_date').val(s2);
            },
            time: {
                enabled: true
            },
            defaultTime: moment().subtract(1, 'month').startOf('month').startOf('day').toDate(),
            defaultEndTime: moment().endOf('day').toDate()
        });
    $(function () {
        $(".popover-options a").popover({
            html: true
        });
    });

</script>
</html>
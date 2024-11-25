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
        <input type="hidden" id="host" value="<?=$form['host']?>">
        <input type="hidden" id="port" value="<?=$form['port']?>">
        <input type="hidden" id="db" value="<?=$form['db']?>">
        <input type="hidden" id="password" value="<?=$form['password']?>">
        <div class="form-group">
            <label class="col-sm-4 control-label" for="status">数据类型</label>
            <div class="col-sm-4">
                <select id="data_type" name="data_type" class="form-control">
                    <option value="string" <?php if('string'==$form['data_type']){ echo "selected";}?>>String（字符串）</option>
                    <option value="list" <?php if('list'==$form['data_type']){ echo "selected";}?>>List（列表）</option>
                    <option value="set" <?php if('set'==$form['data_type']){ echo "selected";}?>>Set（集合）</option>
                    <option value="hash" <?php if('hash'==$form['data_type']){ echo "selected";}?>>Hash（散列）</option>
                    <option value="zset" <?php if('zset'==$form['data_type']){ echo "selected";}?>>Zset（有序集合）</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="redis_key">键名</label>
            <div class="col-sm-4">
                <input   name="redis_key" id="redis_key" type="redis_key" value="<?=$form['redis_key']?>" placeholder="键名" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="redis_value">值</label>
            <div class="col-sm-4">
                <input  id="redis_value"     style="width: 500px;height: 200px;padding-top: 0px;" value="<?=$form['redis_value']?>">
            </div>
        </div>

    </div>
</div>

</body>
<?php \app\helpers\AppAsset::run_javascript_end()?>

</html>
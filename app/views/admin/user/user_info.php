<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>区服开启</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <script src="<?=STATIC_URL?>js/html5shiv.min.js"></script>
    <script src="<?=STATIC_URL?>js/respond.min.js"></script>
    <![endif]-->
    <?=\app\helpers\AppFormAsset::run()?>
    <script >
        layer.config({
            skin: 'layer-ext-moon',
            extend: 'moon/style.css'
        });
    </script>
</head>
<body>
<div class="form-wrapper">
    <div class="form-item min-pop" style="width: 300px;margin:10px auto;">
        <div class="form-inline">
            <div class="form-group">
                <label class="control-label">密码：</label>
                <input type="password" id="password" style="width: 250px" class="form-control">
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group">
                <label class="control-label">再次输入：</label>
                <input type="password" id="re_password" style="width: 250px" class="form-control">
            </div>
        </div>
    </div>
</div>
</body>
<?=\app\helpers\AppFormAsset::run_javascript_end()?>
 
</html>
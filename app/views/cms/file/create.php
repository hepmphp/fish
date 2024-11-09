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
    <script  src="<?= STATIC_URL ?>/js/layer/layer.js"></script>
</head>
<body>
<div class="container col-sm-12" style="margin-top: 10px;">
    <div class="form-horizontal">
        <input type="hidden" id="id" value="<?=$form['id']?>">
        <!-- Select Basic -->
        <style>
            .image_list_class {
                margin-left: 220px;
            }
         </style>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="folder_id">所属分类</label>
            <div class="col-sm-4">
                <select id="folder_id" name="folder_id" class="form-control">
                    <option value="">请选择</option>
                    <?=$config_folder_id?>
                </select>
            </div>
        </div>
        <script>
            var images_list = <?php echo json_encode([$form['file']]); ?>;
            var image_list_url = <?php echo json_encode([$form['file_url']]); ?>;
        </script>
        <?php include APP_PATH.'/views/admin/root/upload.php';?>
    </div>
</div>

</body>
<?php \app\helpers\AppFormAsset::run_javascript_end()?>
</html>
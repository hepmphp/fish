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
    <script src="<?= STATIC_URL ?>js/html5shiv.min.js"></script>
    <script src="<?= STATIC_URL ?>js/respond.min.js"></script>
    <![endif]-->
    <?php \app\helpers\AppAsset::run()?>
    <script >
        layer.config({
            skin: 'layer-ext-moon',
            extend: 'moon/style.css'
        });
    </script>

</head>
<div class="form-wrapper">
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>

            </thead>
            <tbody>
            <?php foreach ($info as $k=>$v){?>
            <tr>
                <td><?=$k?></td><td><?=$v?></td>
            </tr>
            <?php }?>

            </tbody>
        </table>
    </div>

</div>


<?php \app\helpers\AppAsset::run_javascript_end()?>
</body>


</html>

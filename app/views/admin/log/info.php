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

</head>
<body>
<div class="table-wrap">

    <table data-toggle="table" class="table-item table" >
        <tbody>
        <tr>
            <td>日志类型</td>
            <td><?=$form['log_type_name']?></td>
        </tr>
        <tr>
            <td>id</td>
            <td><?=$form['id']?></td>
        </tr>
        <tr>
            <td>用户id</td>
            <td><?=$form['user_id']?></td>
        </tr>
        <tr>
            <td>用户名</td>
            <td><?=$form['username']?></td>
        </tr>
        <tr>
            <td>ip</td>
            <td><?=$form['ip']?></td>
        </tr>
        <tr>
            <td>控制器</td>
            <td><?=$form['m']?></td>
        </tr>
        <tr>
            <td>方法</td>
            <td><?=$form['a']?></td>
        </tr>
        <tr>
            <td>操作时间</td>
            <td><?=$form['addtime']?></td>
        </tr>
        </tbody>
    </table>
    <p><?php highlight_string($form['info'])?></p>
</div>

</body>


</html>
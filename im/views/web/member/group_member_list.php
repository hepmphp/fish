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
    <div class="form-item">
        <form class="form-inline clearfix" role="form"  action="#" method="get">
            <div class="form-group">
                <label class="control-label">群号：</label>
                <input placeholder="文本" class="form-control" name="account" id="account" value="" type="text">
            </div>

            <a class="btn btn-info m-l" onclick="search_list()" > 查询</a>
        </form>
    </div>
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>
            <tr>
                <th>用户id</th>
                <th>用户名</th>
                <th>头像</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['list'] as $k=>$v){?>
            <tr>
                <td><?=$v['id']?></td>
                <td><?=$v['username']?></td>
                <td><img src="<?=$v['avatar_url']?>"></td>
                <td><a class="btn btn-info m-l btn_invate" data-to_username="<?=$v['username']?>" data-id="<?=$v['id']?>" data-group_id="<?=$form['group_id']?>"> 发送邀请</a></td>
            </tr>
            <?php }?>

            </tbody>
        </table>
    </div>
</div>

<script src="<?= STATIC_URL ?>/js/logic/admin/ajax.js?<?=rand()?>"></script>
<script src="<?= STATIC_URL ?>/js/jquery.min.js"></script>
<script src="<?= STATIC_URL ?>/js/layer/layer.js"></script>

<?php \app\helpers\AppAsset::run_javascript_end()?>
</body>
<script>
    $('.btn_invate').click(function () {
            var user_id = $(this).data('id');
            var group_id = $(this).data('group_id');
            console.log('btn_invate_callback');
            var invate_message = {
                to_id:user_id,
                group_id:group_id,
                type:'invate_message'
            };
            console.log("sendMessage:invate_message",invate_message)
            parent.window.Gsocket.send(JSON.stringify(invate_message));

    });
</script>

</html>
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
    <?php \app\helpers\AppFormAsset::run()?>


</head>
<body style="border: 2px dotted #1278f6">
<div class="form-wrapper">




</div>


<?php \app\helpers\AppFormAsset::run_javascript_end()?>
</body>
<script  src="<?=SITE_URL?>tool/webssh/node_modules/socket.io/client-dist/socket.io.js"></script>;
<script>

    var form = <?=json_encode($form)?>;

</script>
<script>
    var socket_result = '';
    window.onload = function() {
        socket = io('127.0.0.1:8900/'); //.connect();
        // Backend -> Browser
        socket.on('data', function(data) {
            // console.log(data);
            var tr = '<div style="text-align: center;vertical-align:center;line-height:30px;background-color: #1278f6;color:#FFFFFF;font-weight: bold;font-size:16px;height:30px;">系统信息</div><div class="table-wrap" style="border: 1px dotted #1278f6"> <table  data-toggle="table" class="table-item table">';
            $.each(data,function (i,v){
                console.log(v);
                v_data = v.split(',');
                tr = tr+'<tr>'
                $.each(v_data,function (i1,v1){
                    tr = tr+'<td>'+v1+'</td>'
                });
                tr = tr+'</tr>'
                console.log(i);
            });

            tr = tr+'</table></div>';

           $('.form-wrapper').append(tr);
        });

        socket.on('disconnect', function() {
            console.log('disconnect');
        });
        <?php foreach ($form_cmd as $cmd){
            $form['cmd'] = $cmd;

            ?>
        socket.send(<?=json_encode($form)?>);
        <?php }?>
    }

</script>


</html>

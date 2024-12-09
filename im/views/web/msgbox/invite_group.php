<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>消息盒子</title>

    <link rel="stylesheet" href="<?=STATIC_URL?>layim2/dist/css/layui.css">
    <link rel="stylesheet" href="<?=SITE_URL?>static/im/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=SITE_URL?>static/im/css/style.css">
    <style>
        .layim-msgbox{margin: 15px;}
        .layim-msgbox li{position: relative; margin-bottom: 10px; padding: 0 130px 10px 60px; padding-bottom: 10px; line-height: 22px; border-bottom: 1px dotted #e2e2e2;}
        .layim-msgbox .layim-msgbox-tips{margin: 0; padding: 10px 0; border: none; text-align: center; color: #999;}
        .layim-msgbox .layim-msgbox-system{padding: 0 10px 10px 10px;}
        .layim-msgbox li p span{padding-left: 5px; color: #999;}
        .layim-msgbox li p em{font-style: normal; color: #FF5722;}

        .layim-msgbox-avatar{position: absolute; left: 0; top: 0; width: 50px; height: 50px;}
        .layim-msgbox-user{padding-top: 5px;}
        .layim-msgbox-content{margin-top: 3px;}
        .layim-msgbox .layui-btn-small{padding: 0 15px; margin-left: 5px;}
        .layim-msgbox-btn{position: absolute; right: 0; top: 12px; color: #999;}
    </style>
</head>
<body>
<script src="<?= STATIC_URL ?>/js/jquery.min.js"></script>
<script src="<?= STATIC_URL ?>/layim2/dist/lay/modules/layer.js"></script>

<ul class="layim-msgbox" id="LAY_view">
        <?php if($form['type']==3){?>
        <li data-uid="<?=$form['to_id']?>" data-fromgroup="0">
            <a href="" target="_blank">
                <img src="<?=$form['avatar_url']?>" class="layui-circle layim-msgbox-avatar"> </a>
            <p class="layim-msgbox-group">
                <a href="#" target="_blank" data-to_id="<?=$form['to_id']?>"><?=$form['from_username']?></a><span><?=date("Y-m-d H:i:s",$form['send_time'])?></span> <span>刚刚</span> </p>
            <p class="layim-msgbox-content"> 申请加群 <span>附言: <?=$form['remark']?></span> </p> <p class="layim-msgbox-btn">
            <?php if($form['status']==0){?>
                <button class="layui-btn layui-btn-small" data-action="agree_or_refuse_group" data-type="agree" data-group_id="<?=$form['group_id']?>"    data-to_id="<?=$form['to_id']?>"  data-to_username="<?=$form['to_username']?>">同意</button>
                <button class="layui-btn layui-btn-small layui-btn-primary"  data-action="agree_or_refuse_group" data-type="refuse" data-group_id="<?=$form['group_id']?>"    data-to_id="<?=$form['to_id']?>"  data-to_username="<?=$form['to_username']?>">拒绝</button> </p> </li>
            <?php }else{ ?>
                <span><?php if($form['status']==1){echo "<em style='color:blue'>已同意</em>";}else{echo "<em style='color: red;'>已拒绝</em>";}?></span>
            <?php }?>
        <?php }?>
</ul>


<script src="<?= STATIC_URL ?>/js/jquery.min.js?<?=rand()?>"></script>
<script>
    var active = {
        agree_or_refuse_group: function(data){
            console.log(data);
            $.ajax({
                type: "POST",
                url: '/im.php/api/msgbox/system_agree_or_refuse_group',
                data: data,
                timeout: "4000",
                dataType: 'json',
                success: function (data) {
                    layer.closeAll('loading');
                    parent.layer.msg('操作成功',{icon:1});
                },
            });
        }
    };
    $('body').on('click', '.layui-btn', function(){
        console.log($(this).data('from_id'));
        var that = $(this);
        var action = that.data('action');
        var type = that.data('type');
        var status =1;
        if(type=='agree'){
            status =1;
        }else{
            status =2;
        }
        var opt_data = {
            group_id:that.data('group_id'),
            from_id:that.data('from_id'),
            from_username:that.data('from_username'),
            to_id:that.data('to_id'),
            to_username:that.data('to_username'),
            status:status
        };
        active[action] ? active[action].call(this, opt_data) : ''

    });
</script>

</body>
</html>

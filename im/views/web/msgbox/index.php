<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>消息盒子</title>

    <link rel="stylesheet" href="<?=STATIC_URL?>layim2/dist/css/layui.css">
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
<script src="<?= STATIC_URL ?>/layim2/dist/lay/modules/layer.js"></script> //im/
<ul class="layim-msgbox" id="LAY_view">
    <?php foreach ($data['list'] as $k=>$v){?>
            <?php if($v['type']==2){?>
    <li data-uid="<?=$v['from_id']?>" data-fromgroup="0">
        <a href="" target="_blank">
            <img src="http://127.0.0.1/upload/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg" class="layui-circle layim-msgbox-avatar"> </a>
        <p class="layim-msgbox-user">
            <a href="#" target="_blank" data-to_id="<?=$v['to_id']?>"><?=$v['to_username']?></a> <span>刚刚</span> </p>
        <p class="layim-msgbox-content"> 申请添加你为好友 <span>附言: <?=$v['remark']?></span> </p> <p class="layim-msgbox-btn">
            <button class="layui-btn layui-btn-small" data-type="agree" data-group_id="<?=$v['group_id']?>"  data-from_id="<?=$v['from_id']?>" data-from_username="<?=$v['from_username']?>" data-to_id="<?=$v['to_id']?>"  data-to_username="<?=$v['to_username']?>">同意</button>
            <button class="layui-btn layui-btn-small layui-btn-primary" data-type="refuse" data-group_id="<?=$v['group_id']?>"  data-from_id="<?=$v['from_id']?>" data-from_username="<?=$v['from_username']?>" data-to_id="<?=$v['to_id']?>"  data-to_username="<?=$v['to_username']?>">拒绝</button> </p> </li>
        <?php }else{?>
            <li data-uid="<?=$v['from_id']?>" data-fromgroup="0">
                <a href="" target="_blank">
                    <img src="http://127.0.0.1/upload/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg" class="layui-circle layim-msgbox-avatar"> </a>
                <p class="layim-msgbox-group">
                    <a href="#" target="_blank" data-to_id="<?=$v['from_id']?>"><?=$v['from_username']?></a> <span>刚刚</span> </p>
                <p class="layim-msgbox-content"> 申请加群 <span>附言: <?=$v['remark']?></span> </p> <p class="layim-msgbox-btn">
                    <button class="layui-btn layui-btn-small" data-type="agree" data-group_id="<?=$v['group_id']?>"  data-from_id="<?=$v['from_id']?>" data-from_username="<?=$v['from_username']?>" data-to_id="<?=$v['to_id']?>"  data-to_username="<?=$v['to_username']?>">同意</button>
                    <button class="layui-btn layui-btn-small layui-btn-primary" data-type="refuse" data-group_id="<?=$v['group_id']?>"  data-from_id="<?=$v['from_id']?>" data-from_username="<?=$v['from_username']?>" data-to_id="<?=$v['to_id']?>"  data-to_username="<?=$v['to_username']?>">拒绝</button> </p> </li>
        <?php }?>
    <?php }?>
<!--    <li class="layim-msgbox-system"> <p><em>系统：</em>雷军 拒绝了你的好友申请<span>10天前</span></p> </li>-->
<!--    </li>< div class="layui-flow-more"><li class="layim-msgbox-tips">暂无更多新消息</li></div>-->
</ul>
<script src="<?=STATIC_URL?>layim2/dist/layui.js"></script>

    //操作
    // var active = {
    //     //同意
    //     agree: function(othis){
    //         var li = othis.parents('li')
    //             ,uid = li.data('uid')
    //             ,from_group = li.data('fromGroup')
    //             ,user = cache[uid];
    //
    //         //选择分组
    //         parent.layui.layim.setFriendGroup({
    //             type: 'friend'
    //             ,username: user.username
    //             ,avatar: user.avatar
    //             ,group: parent.layui.layim.cache().friend //获取好友分组数据
    //             ,submit: function(group, index){
    //
    //                 //将好友追加到主面板
    //                 parent.layui.layim.addList({
    //                     type: 'friend'
    //                     ,avatar: user.avatar //好友头像
    //                     ,username: user.username //好友昵称
    //                     ,groupid: group //所在的分组id
    //                     ,id: uid //好友ID
    //                     ,sign: user.sign //好友签名
    //                 });
    //                 parent.layer.close(index);
    //                 othis.parent().html('已同意');
    //
    //
    //                 //实际部署时，请开启下述注释，并改成你的接口地址
    //                 /*
    //                 $.post('/im/agreeFriend', {
    //                   uid: uid //对方用户ID
    //                   ,from_group: from_group //对方设定的好友分组
    //                   ,group: group //我设定的好友分组
    //                 }, function(res){
    //                   if(res.code != 0){
    //                     return layer.msg(res.msg);
    //                   }
    //
    //                   //将好友追加到主面板
    //                   parent.layui.layim.addList({
    //                     type: 'friend'
    //                     ,avatar: user.avatar //好友头像
    //                     ,username: user.username //好友昵称
    //                     ,groupid: group //所在的分组id
    //                     ,id: uid //好友ID
    //                     ,sign: user.sign //好友签名
    //                   });
    //                   parent.layer.close(index);
    //                   othis.parent().html('已同意');
    //                 });
    //                 */
    //
    //             }
    //         });
    //     }
    //
    //     //拒绝
    //     ,refuse: function(othis){
    //         var li = othis.parents('li')
    //             ,uid = li.data('uid');
    //
    //         layer.confirm('确定拒绝吗？', function(index){
    //             $.post('/im/refuseFriend', {
    //                 uid: uid //对方用户ID
    //             }, function(res){
    //                 if(res.code != 0){
    //                     return layer.msg(res.msg);
    //                 }
    //                 layer.close(index);
    //                 othis.parent().html('<em>已拒绝</em>');
    //             });
    //         });
    //     }
    // };

<script>
    layui.use(['layim', 'flow'], function() {
        var layim = layui.layim
            , layer = layui.layer
            , laytpl = layui.laytpl
            , $ = layui.jquery
            , flow = layui.flow;
        var active = {
            agree: function(data){
                console.log(data);
                $.ajax({
                    type: "POST",
                    url: '/im.php/api/msgbox/agree_or_refuse',
                    data: data,
                    timeout: "4000",
                    dataType: 'json',
                    success: function (data) {
                        layer.closeAll('loading');
                        if (data.code == 0) {
                            parent.layui.layim.setFriendGroup({
                                type: 'friend'
                                ,username: data.data.from_username
                                ,avatar: ''
                                ,group: parent.layui.layim.cache().friend //获取好友分组数据
                                ,submit: function(group, index) {
                                    //将好友追加到主面板
                                    parent.layui.layim.addList({
                                        type: 'friend'
                                        , avatar: '' //好友头像
                                        , username:data.data.to_username //好友昵称
                                        , groupid: group //所在的分组id
                                        , id: data.data.to_id //好友ID
                                        , sign:'', //好友签名
                                    });
                                    console.log( parent.layer);
                                    // parent.layer.close(index);
                                    $(this).parent().html('已同意');
                                    parent.layer.alert('操作成功', {icon:1}, function(){
                                        parent.window.location.reload();
                                    });
                                }
                            });
                        } else {

                        }
                    },
                });
            }
        };
        $('body').on('click', '.layui-btn', function(){
            console.log($(this).data('from_id'));
            var that = $(this);
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
            active[type] ? active[type].call(this, opt_data) : ''

        });
    });

</script>

</body>
</html>

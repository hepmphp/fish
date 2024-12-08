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
    <?php foreach ($data['list'] as $k=>$v){?>
            <?php if($v['type']==0){?>
    <li data-uid="<?=$v['from_id']?>" data-fromgroup="0">
        <a href="" target="_blank">
            <img src="http://127.0.0.1/upload/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg" class="layui-circle layim-msgbox-avatar"> </a>
        <p class="layim-msgbox-user">
            <a href="#" target="_blank" data-to_id="<?=$v['to_id']?>"><?=$v['to_username']?></a> <span><?=date("Y-m-d H:i:s",$v['send_time'])?></span><span>刚刚</span> </p>
        <p class="layim-msgbox-content"> 申请添加你为好友 <span>附言: <?=$v['remark']?></span> </p> <p class="layim-msgbox-btn">
            <?php if($v['status']==0){?>
            <button class="layui-btn layui-btn-small" data-action="agree_or_refuse_friend" data-type="agree" data-group_id="<?=$v['group_id']?>"  data-from_id="<?=$v['from_id']?>" data-from_username="<?=$v['from_username']?>" data-to_id="<?=$v['to_id']?>"  data-to_username="<?=$v['to_username']?>">同意</button>
            <button class="layui-btn layui-btn-small layui-btn-primary" data-action="agree_or_refuse_friend" data-type="refuse" data-group_id="<?=$v['group_id']?>"  data-from_id="<?=$v['from_id']?>" data-from_username="<?=$v['from_username']?>" data-to_id="<?=$v['to_id']?>"  data-to_username="<?=$v['to_username']?>">拒绝</button> </p> </li>
            <?php }else{ ?>
                <span><?php if($v['status']==1){echo "<em style='color:blue'>已同意</em>";}else{echo "<em style='color: red;'>已拒绝</em>";}?></span>
            <?php }?>
        <?php }elseif($v['type']==2){?>
            <li data-uid="<?=$v['from_id']?>" data-fromgroup="0">
                <a href="" target="_blank">
                    <img src="http://127.0.0.1/upload/2024/12/05/f0ae2f70ff77720b457a4e8e54858901.jpg" class="layui-circle layim-msgbox-avatar"> </a>
                <p class="layim-msgbox-group">
                    <a href="#" target="_blank" data-to_id="<?=$v['from_id']?>"><?=$v['from_username']?></a><span><?=date("Y-m-d H:i:s",$v['send_time'])?></span> <span>刚刚</span> </p>
                <p class="layim-msgbox-content"> 申请加群 <span>附言: <?=$v['remark']?></span> </p> <p class="layim-msgbox-btn">
            <?php if($v['status']==0){?>
                    <button class="layui-btn layui-btn-small" data-action="agree_or_refuse_group" data-type="agree" data-group_id="<?=$v['group_id']?>"  data-from_id="<?=$v['from_id']?>" data-from_username="<?=$v['from_username']?>" data-to_id="<?=$v['to_id']?>"  data-to_username="<?=$v['to_username']?>">同意</button>
                    <button class="layui-btn layui-btn-small layui-btn-primary"  data-action="agree_or_refuse_group" data-type="refuse" data-group_id="<?=$v['group_id']?>"  data-from_id="<?=$v['from_id']?>" data-from_username="<?=$v['from_username']?>" data-to_id="<?=$v['to_id']?>"  data-to_username="<?=$v['to_username']?>">拒绝</button> </p> </li>
                <?php }else{ ?>
                <span><?php if($v['status']==1){echo "<em style='color:blue'>已同意</em>";}else{echo "<em style='color: red;'>已拒绝</em>";}?></span>
                <?php }?>
        <?php }?>
    <?php }?>

<!--    <li class="layim-msgbox-system"> <p><em>系统：</em>雷军 拒绝了你的好友申请<span>10天前</span></p> </li>-->
<!--    </li>< div class="layui-flow-more"><li class="layim-msgbox-tips">暂无更多新消息</li></div>-->
</ul>
<div class="page-bottom clearfix">
    <div class=" pagination">
        <ul class="pagination pagination-outline">

            <?php
            $pre_has_show = true;
            $next_has_show = true;
            $i = 0;
            for($i=1;$i<=$data['total_page'];$i++){?>
                <?php if($pre_has_show){$pre_has_show = false;?>
                    <li class="page-pre"><a href="javascript:void(0)" data-id="">&laquo;</a></li>
                <?php }?>
                <?php if($i<=10){ ?>
                    <li class="page-number <?php if($i==$data['page']){echo 'active';}?>"><a data-page="<?=$i?>" href="javascript:void(0)"><?=$i?></a></li>
                    <?php if($i==$data['total_page'] && $next_has_show){$next_has_show = false;?>
                    <li class="page-next"><a href="javascript:void(0)" data-page="<?=($data['page']+1)?>">&raquo;</a></li>
                        <?php }?>
                <?php }?>
          <?php }?>
            <span class="page-list">每页显示
                <span class="btn-group dropup">
                        <select class="form-control" id="per_page" onchange="change_page()">
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                        </select>
                </span>条</span>
            <div class="div_right">
                <a href="javascript:void(0)" id="jump_page_click" style="margin-right: 10px;" onclick="go_page()">跳转</a>
                <input class="form-control jump-page" id="jump_page" size="2" maxlength="7" type="text"
                       style="width: 40px;">

            </div>
        </ul>
    </div>
</div>
<style>
    .pagination{
        width: 400px;
        margin-top: 20px;
        margin-bottom: 0;
    }
    .pagination-outline{
        margin-left: 30px;

    }
    .page-list{
        float: left;
    }
    .div_right{
        float: left;
        width: 90px;
    }
    #jump_page_click{
        float: right;
        margin-top: 8px;
    }
    .page-bottom{
        margin-top: -30px;
        margin-bottom: 0;
        text-align: center;
        border-bottom: 1px dotted #e2e2e2;
    }

    .layim-msgbox{
        margin-top: 15px;
    }

</style>

<script src="<?= STATIC_URL ?>/js/jquery.min.js?<?=rand()?>"></script>
<script>
    function ajax_list(param){
        window.location.href = '/im.php/web/msgbox/index?'+$.param(param);
    }
    $(".pagination-outline").delegate('a', 'click', function () {
        console.log('pagination-outline');
        $(this).parent('li').addClass('active').siblings().removeClass('active');
        //console.log($(this).find('li').addClass('c'));
        var page = $(this).data('page');
        var param = {
            page: page,
            per_page: $('#per_page').val(),
        };
        ajax_list(param);
    });
    $(document).ready(function () {
        window.go_page =function go_page() {
            var page = $('#jump_page').val();
            var per_page = $('#per_page').val();
            var param = {
                page: page,
                per_page: per_page,
            };
            ajax_list(param);
        }

        $("#jump_page").keydown(function (e) {
            var curKey = e.which;
            console.log(curKey);
            if (curKey == 13) {
                $('#jump_page_click').trigger('click');
            }
        });


        window.change_page =function change_page() {
            var per_page = $('#per_page').val();
            var param = {
                page: 1,
                per_page: per_page,
            };
            ajax_list(param);
        }
    });

</script>
<script src="<?=STATIC_URL?>layim2/dist/layui.js"></script>
<script>
    layui.use(['layim', 'flow'], function() {
        var layim = layui.layim
            , layer = layui.layer
            , laytpl = layui.laytpl
            , $ = layui.jquery
            , flow = layui.flow;
        var active = {
            agree_or_refuse_friend: function(data){
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
                            if(data.data.status==1){
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
                                        parent.layer.alert('操作成功', {icon:1}, function(alert_index){
                                            parent.layer.close(alert_index);
                                            parent.layer.close(index);
                                            //parent.window.location.reload();
                                        });
                                    }
                                });
                            }else{
                                $(this).parent().html('<em>已拒绝</em>');
                                parent.layer.alert('拒绝操作成功', {icon:1}, function(alert_index){
                                    parent.layer.close(alert_index);
                                    parent.layer.close(index);
                                });
                            }

                        } else {

                        }
                    },
                });
            },
            agree_or_refuse_group: function(data){
                console.log(data);
                $.ajax({
                    type: "POST",
                    url: '/im.php/api/msgbox/agree_or_refuse_group',
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
    });

</script>

</body>
</html>

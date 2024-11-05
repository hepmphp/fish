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
                <label class="control-label">用户ID：</label>
                <input placeholder="文本" class="form-control" name="id" id="id" value="<?=$form['id']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">用户名字：</label>
                <input placeholder="文本" class="form-control" name="username" id="username" value="<?=$form['username']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">状态：</label>
                <select id="status" name="status" class="form-control">
                    <option value="">请选择</option>
                    <?php
                    foreach($config_status as $k=>$vo){
                        ?>
                        <option value="<?=$vo['id']?>" <?php  if($vo['id']==$form['status']){ echo "selected";}?>><?=$vo['name']?></option>
                    <?php }?>
                </select>
            </div>        <div class="form-group">
                <label class="control-label">当前用户组ID：</label>
                <input placeholder="文本" class="form-control" name="groupid" id="groupid" value="<?=$form['groupid']?>" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">注册时间：</label>
                <span class="date-range">
            <input placeholder="开始时间" class="form-control date-range00 date-ico" name="begin_addtime" type="text" value="<?=$form['begin_addtime']?>">
            <input placeholder="结束时间" class="form-control date-range01 date-ico" name="end_addtime" type="text" value="<?=$form['end_addtime']?>">
            </span>
            </div>
            <a class="btn btn-info m-l" onclick="search_list()" > 查询</a>
            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="add()">
        </form>
    </div>
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>
            <tr>

                <th>用户ID</th>
                <th>用户名字</th>
                <th>Email地址</th>
                <th>随机密码</th>
                <th>状态</th>
                <th>当前用户组ID</th>
                <th>注册时间</th>
                <th>用户附加组的ID缓存字段</th>

                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            </tbody>
        </table>
    </div>
    <?php \app\helpers\PageWidget::run();?>
</div>

<script src="<?= STATIC_URL ?>/js/logic/admin/ajax.js?<?=rand()?>"></script>

<script>
    var per_page = $('#per_page').val();
    var param = {
        page: 1,
        per_page: per_page,
    };

    function search_list(){
        var search_param= {
            page: 1,
            per_page : $("#admin").val().length==0?100:1,
            admin: $("#admin").val(),
            title:$('#title').val(),
            start_time:$('#start_time').val(),
            end_time:$('#end_time').val(),
            status:$('#status').val(),
        };

        console.log(search_param);
        ajax_list(search_param);
    }
    ajax_list(param);
    function ajax_list(param) {
        layer.load(2);

        var template = '<tr>' +

            '<td>[id]</td>'+
            '<td>[username]</td>'+
            '<td>[email]</td>'+
            '<td>[password]</td>'+
            '<td>[status]</td>'+
            '<td>[groupid]</td>'+
            '<td>[addtime]</td>'+
            '<td>[groups]</td>'+

            '<a onclick="delete_bbs_user(\'[id]\')" class="">[删除]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/bbs_user/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.
                    replace('[id]', d.id).
                    replace('[username]', d.username).
                    replace('[email]', d.email).
                    replace('[password]', d.password).
                    replace('[status]', d.status).
                    replace('[groupid]', d.groupid).
                    replace('[addtime]', d.addtime).
                    replace('[groups]', d.groups).

                });
                $('table tbody').html(list_html);
                var total_num = data.data.total;
                $('.pagination-outline').html(multi(total_num, param.per_page, param.page, 100));
                $(".table").bootstrapTable('resetView');
                // window.console.clear();

            } else {
                layer.alert(data.msg);
            }

        });
    }

</script>
<?php \app\helpers\AppAsset::run_javascript_end()?>
</body>
</html>
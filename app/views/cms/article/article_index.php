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
    <script src="<?= STATIC_URL ?>/js/html5shiv.min.js"></script>
    <script src="<?= STATIC_URL ?>/js/respond.min.js"></script>
    <![endif]-->
    <?=\helpers\AppAsset::run()?>
    <script >
        layer.config({
            skin: 'layer-ext-moon',
            extend: 'moon/style.css'
        });
    </script>

</head>
<div class="form-wrapper">
    <div class="form-item">

        <form class="form-inline clearfix" role="form"  action="" method="get">

            <div class="form-group">
                <label class="control-label">用户名：</label>
                <input placeholder="文本" class="form-control" name="username" id="username" value="" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">标题：</label>
                <input placeholder="文本" class="form-control" name="title" id="title" value="" type="text">
            </div>
            <div class="form-group">
                <label class="control-label">添加时间：</label>
                <span class="date-range">
            <input placeholder="开始时间" class="form-control date-range00 date-ico" name="start_time" type="text" value="">
            <input placeholder="结束时间" class="form-control date-range01 date-ico" name="end_time" type="text" value="">
            </span>
            </div>
            <div class="form-group">
                <label class="control-label">状态：</label>
                <select id="status" name="status" class="form-control">
                    <option value="0">正常</option>
                    <option value="-1">删除</option>
                </select>
            </div>
            <button class="btn btn-info m-l" type="submit"> 查询</button>
            <input class="btn btn-info m-l" value="添加" name="search" type="button" style="width:60px;" onclick="article_layer_form()">
        </form>
    </div>
    <div class="table-wrap">
        <table  data-toggle="table" class="table-item table">
            <thead>
            <tr>
                <th>用户名</th>
                <th>标题</th>
                <th>关键词</th>
                <th>分类</th>
                <th>标签id  </th>
                <th>描述</th>
                <th>添加时间</th>
                <th>是否置顶</th>
                <th>列表显示图片</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<script src="<?= STATIC_URL ?>/js/logic/admin/ajax.js?<?=rand()?>"></script>
<script >
    $('.date-range').dateRangePicker(
        {
            separator: ' to ',
            format: 'YYYY-MM-DD HH:mm:ss',
            endDate: moment(),
            getValue: function () {

                if ($('.date-range00').val() && $('.date-range01').val())
                    return $('.date-range00').val() + ' 至 ' + $('.date-range01').val();
                else
                    return '';
            },
            setValue: function (s, s1, s2) {
                $('.date-range00').val(s1);
                $('.date-range01').val(s2);
            },
            time: {
                enabled: true
            },
            defaultTime: moment().subtract(1, 'month').startOf('month').startOf('day').toDate(),
            defaultEndTime: moment().endOf('day').toDate()
        });
    $(function () {
        $(".popover-options a").popover({
            html: true
        });
    });

</script>
<script>
    var per_page = $('#per_page').val();
    var param = {
        page: 1,
        per_page: per_page,
        id: $.cookie('id'),
        admin_username: $.cookie('username'),
        access_token: $.cookie('access_token')
    };

    function search_list(){
        var search_param= {
            page: 1,
            per_page : $("#username").val().length==0?100:1,
            id: $.cookie('id'),
            username: $("#username").val(),
            access_token: $.cookie('access_token'),
            start_time:$('#start_time').val(),
            end_time:$('#end_time').val()
        };

        console.log(search_param);
        ajax_list(search_param);
    }
    ajax_list(param);
    function ajax_list(param) {
        layer.load(2);
        var template = '<tr><td >[id]</td>' +
            '<td>[status]</td>' +
            '<td>[username]</td>' +
            '<td>[realname]</td>' +
            '<td>[group_name]</td>' +
            '<td>[create_time]</td>' +
            '<td>[update_time]</td>' +
            '<td>[last_session_id]</td>' +
            '<td><a onclick="edit_user(\'[id]\')" class="" data-id="[id]">[修改]</a>' +
            '<a onclick="group_permission(\'[id]\')" class="">[分配权限]</a>' +
            '<a  onclick="lock_user(\'[id]\')" style="color: red">[锁定]</a></td></tr>';
        var list_html = '';
        $.getJSON('/api/user/get_list/?' + $.param(param), function (data) {
            layer.closeAll();
            if (data.status == 0) {
                $.each(data.data.list, function (i, d) {
                    list_html += template.replace(/\[id\]/g, d.id).
                    replace('[status]', d.status_name).
                    replace('[username]', d.username).
                    replace('[realname]', d.realname).
                    replace('[group_name]', d.group_name).
                    replace('[create_time]', d.create_time).
                    replace('[update_time]', d.update_time).
                    replace('[last_session_id]', d.last_session_id);
                });
                $('table tbody').html(list_html);
                var total_num = data.data.total;
                $('.pagination-outline').html(multi(total_num, param.per_page, param.page, 100));
                $('#bootstrap-table-js').attr('src',$('#bootstrap-table-js').attr('src')+'?'+<?=rand()?>);
                $('#bootstrap-table-js-cn').attr('src',$('#bootstrap-table-js-cn').attr('src')+'?'+<?=rand()?>);
                // window.console.clear();
                call_debug_log();
            } else {
                layer.alert(data.msg);
            }

        });
    }


    function article_layer_form(url,action=1){
        var content = '/cms/article/create';
        var title = action==1?'添加':'修改';
        var btn =  action==1?['确认添加','取消']:['确认修改','取消'];
        var layer_index = layer.open({
            type: 2, //iframe
            area: ['500px', '560px'],
            title: title,
            btn: btn,
            shade: 0.3, //遮罩透明度
            content:content,
            yes: function(index, layero){
                var body = layer.getChildFrame('body', index);
                var param ={
                    id:body.find('#id').val(),
                    cate_id:body.find('#cate_id').val(),
                    tag_id:body.find('#tag_id').val(),
                    admin_id:body.find('#admin_id').val(),
                    admin_username:body.find('#admin_username').val(),
                    title:body.find('#title').val(),
                    keywords:body.find('#keywords').val(),
                    description:body.find('#description').val(),
                    content:body.find('#content').val(),
                    addtime:body.find('#addtime').val(),
                    update_time:body.find('#update_time').val(),
                    is_top:body.find('#is_top').val(),
                    list_image_url:body.find('#list_image_url').val(),
                    status:body.find('#status').val()
                }

                ajax_post(url,param);

            },btn2: function(index, layero){

            }
        });
        layer.full(layer_index);
    }
</script>
<!-- Bootstrap table -->
<script id="bootstrap-table-js" src="<?= STATIC_URL ?>js/bootstrap-table/bootstrap-table.min.js"></script>
<script id="bootstrap-table-js-cn" src="<?= STATIC_URL ?>js/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<script src="<?= STATIC_URL ?>js/table-demo.js?<?=rand()?>"></script>
</body>
</html>
